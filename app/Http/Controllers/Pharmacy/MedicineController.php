<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pharmacy\MedicineRequest;
use App\Models\Medicine;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

}
