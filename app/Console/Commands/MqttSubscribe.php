<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class MqttSubscribe extends Command
{
    protected $signature = 'mqtt:subscribe';
    protected $description = 'Subscribe to MQTT topic and process messages';

    public function handle()
    {
        $server = config('mqtt.broker');
        $port = config('mqtt.port');
        $username = config('mqtt.username');
        $password = config('mqtt.password');
        $clientId = config('mqtt.client_id');

        try {
            $mqtt = new MqttClient($server, $port, $clientId);
            $connectionSettings = (new ConnectionSettings)
                ->setUsername($username)
                ->setPassword($password);

            $mqtt->connect($connectionSettings, true);

            // Subscribe to topic
            $mqtt->subscribe("products/update", function ($topic, $message) {
                Log::info("Received message on topic {$topic}: {$message}");
            }, config('mqtt.qos'));

            // Keep the script running indefinitely
            while (true) {
                $mqtt->loop();
            }

        } catch (\Exception $e) {
            Log::error("MQTT Subscribe Error: " . $e->getMessage());
        }
    }
}
