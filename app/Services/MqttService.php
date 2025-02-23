<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class MqttService
{
    public function publishProductId($productId)
    {
        $this->sendToMqtt($productId);
        $this->sendToApi($productId);
    }
    
    private function sendToMqtt($productId)
    {
        $server = config('mqtt.broker');
        $port = config('mqtt.port');
        $clientId = config('mqtt.client_id');

        try {
            $mqtt = new MqttClient($server, $port, $clientId);
            $connectionSettings = (new ConnectionSettings())
                ->setUsername(config('mqtt.username'))
                ->setPassword(config('mqtt.password'));

            $mqtt->connect($connectionSettings, true);
            $mqtt->publish("products/update", json_encode(['product_id' => $productId]), config('mqtt.qos'));
            $mqtt->disconnect();

        } catch (\Exception $e) {
            Log::error("MQTT Publish Error: " . $e->getMessage());
        }
    }
    
    private function sendToApi($productId)
    {
        $apiUrl = "https://example.com/api/products/update";

        try {
            $response = Http::post($apiUrl, ['product_id' => $productId]);

            if ($response->successful()) {
                Log::info("Product ID successfully sent to API: " . $response->body());
            } else {
                Log::error("API Request Failed: " . $response->status() . " - " . $response->body());
            }

        } catch (\Exception $e) {
            Log::error("API Error: " . $e->getMessage());
        }
    }
}
