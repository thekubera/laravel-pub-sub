<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Junges\Kafka\Facades\Kafka;
use Illuminate\Support\Facades\Log;
use Junges\Kafka\Contracts\ConsumerMessage;
use Junges\Kafka\Contracts\MessageConsumer;

class KafkaConsumerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kafka:consume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume messages from Kafka topics';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $topic = env('KAFKA_TOPIC', 'hello-world');
        $groupId = env('KAFKA_CONSUMER_GROUP_ID', 'group');
        $brokers = env('KAFKA_BROKERS', 'kafka:9092');


        Log::info("Starting Kafka consumer for topic: {$topic}, group: {$groupId}");

        try {
            Kafka::consumer([$topic], $groupId, $brokers)
                ->withHandler(function (ConsumerMessage $message, MessageConsumer $consumer) {
                    $headers = $message->getHeaders();
                    $body = $message->getBody();
                    Log::info('Received Kafka message', [
                        'headers' => $headers,
                        'body' => $body
                    ]);
                    $this->info(json_encode([
                        'headers' => $headers,
                        'body' => $body
                    ]));
                })
                ->build()
                ->consume();
        } catch (\Exception $e) {
            Log::error('Error consuming Kafka message', ['error' => $e->getMessage()]);
            $this->error('Error consuming Kafka message: ' . $e->getMessage());
        }

        Log::info("Kafka consumer stopped for topic: {$topic}, group: {$groupId}");
    }
}
