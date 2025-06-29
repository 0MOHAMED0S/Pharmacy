<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pharmacy\MedicineRequest;
use App\Models\Medicine;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class MedicineController extends Controller
{
    public function index()
    {
        $auth = Auth::guard('pharmacy')->user()->id;
        $medicinies = Medicine::where('pharmacy_id', $auth)->get();
        return view('main.AllMedicine', compact('medicinies'));
    }
    public function create()
    {
        return view('main.AddMedicine');
    }
    public function store(MedicineRequest $request)
    {
        try {
            $data = $request->validated();
            $path = $request->file('path')->store('MedicineImages', 'public');
            $data['path'] = $path;
            $data['pharmacy_id'] = Auth::user()->id;
            Medicine::create($data);
            return redirect()->back()->with('success', 'The medicine was added successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        //
    }
    public function update(MedicineRequest $request, string $id)
    {
        try {
            // Find the medicine by ID
            $medicine = Medicine::findOrFail($id);
            $data = $request->validated();
            if ($request->hasFile('path')) {
                if ($medicine->path) {
                    Storage::delete('public/' . $medicine->path);
                }
                $path = $request->file('path')->store('MedicineImages', 'public');
                $data['path'] = $path;
            }

            // Update medicine details
            $medicine->update($data);

            return redirect()->route('medicines.index')->with('success', 'Medicine updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred. Please try again.');
        }
    }

    public function destroy(string $id)
    {
        try {
            $item = Medicine::findOrFail($id);
            $item->delete();

            return redirect()->back()->with('success', 'Item deleted successfully.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

public function search(Request $request)
{
    $name = $request->input('name');

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
        'Content-Type' => 'application/json',
    ])->post('https://openrouter.ai/api/v1/chat/completions', [
        'model' => 'mistralai/mistral-7b-instruct',
        'messages' => [
            [
                'role' => 'system',
                'content' => 'You are a helpful medical assistant. Keep responses clear and safe for general users.'
            ],
            [
                'role' => 'user',
                'content' => "Describe the medicine '$name'. Include its medical use, how it works, and common side effects."
            ],
        ],
        'temperature' => 0.5,
    ]);

    $json = $response->json();

    if ($response->successful() && isset($json['choices'][0]['message']['content'])) {
        $description = $json['choices'][0]['message']['content'];

        return redirect()->back()->with([
            'medicine' => [
                'name' => $name,
                'description' => $description,
            ]
        ]);
    }

    return redirect()->back()->with('error', 'AI failed to generate a description.');
}

public function scan(){
    return view('pages.scan.scan');
}
}
