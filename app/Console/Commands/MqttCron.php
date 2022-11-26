<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\ConnectionSettings;
use PhpMqtt\Client\MqttClient;
use Illuminate\Console\Command;

class MqttCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $server   = config('mqtt.host');
        $port     = config('mqtt.port');
        $clientId = config('mqtt.client_id');
        $username = config('mqtt.username');
        $password = config('mqtt.password');
        $clean_session = true;

        $connectionSettings  = new ConnectionSettings();
        $connectionSettings
            ->setUsername($username)
            ->setPassword($password)
            ->setKeepAliveInterval(60)
            ->setLastWillTopic('')
            ->setLastWillMessage('client disconnect')
            ->setLastWillQualityOfService(1);


        $mqtt = new MqttClient($server, $port, $clientId, '3.1.1');

        $mqtt->connect($connectionSettings, $clean_session);

        $mqtt->publish('plan:cron', '{"line_stop": [ true ] }', 2, true);
        Log::info('ResetLineStop', [
            'topic' => 'plan:cron',
            'message' => '{"line_stop": [ true ] }',
            'qos' => 2,
            'retain' => true
        ]);
        $mqtt->disconnect();
    }
}
