<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
class MedicineOrderController extends Controller
{
    public function orderMedicine(Request $request)
    {
        $medicineId = $request->id;
    
        // Store medicine ID in Cache
        Cache::put('last_ordered_medicine', $medicineId, now()->addMinutes(30));
    
        // MQTT Connection
        $server = config('mqtt.broker');
        $port = config('mqtt.port');
        $clientId = config('mqtt.client_id');
        $username = config('mqtt.username');
        $password = config('mqtt.password');
    
        $mqtt = new MqttClient($server, $port, $clientId);
        $connectionSettings = (new ConnectionSettings())
            ->setUsername($username)
            ->setPassword($password);
    
        $mqtt->connect($connectionSettings, true);
    
        // Publish medicine ID
        $mqtt->publish("medicine/order", json_encode(['medicine_id' => $medicineId]), config('mqtt.qos'));
    
        $mqtt->disconnect();
    
        return response()->json(["message" => "Order placed successfully!", "medicine_id" => $medicineId]);
    }
    

    public function getLastOrderedMedicine()
    {
        $medicineId = Cache::get('last_ordered_medicine');
    
        if (!$medicineId) {
            return response()->json(["message" => "No orders found"], 404);
        }
    
        return response()->json(["last_ordered_medicine_id" => $medicineId]);
    }
    
}
