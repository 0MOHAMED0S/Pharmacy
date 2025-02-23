<?php

return [
    'broker' => env('MQTT_BROKER', 'mqtt.example.com'),
    'port' => env('MQTT_PORT', 1883),
    'username' => env('MQTT_USERNAME', 'your_username'),
    'password' => env('MQTT_PASSWORD', 'your_password'),
    'client_id' => env('MQTT_CLIENT_ID', 'laravel-client'),
    'qos' => env('MQTT_QOS', 1), // 0, 1, or 2
];
