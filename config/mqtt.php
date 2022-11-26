<?php
return [
    'host' =>  env('MQTT_HOST', 'mqtt.matra-hillindo.com'),
    'port' =>  env('MQTT_PORT', 1883),
    'client_id' =>  env('MQTT_CLIET_ID', 'laravel_' . str()->random(5)),
    'username' =>  env('MQTT_USERNAME', 'laravel_' . str()->random(5)),
    'password' =>  env('MQTT_PASSWORD', null)
];
