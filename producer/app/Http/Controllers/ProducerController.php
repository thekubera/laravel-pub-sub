<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;

class ProducerController extends Controller
{
    public function produceMessage()
    {
        try {
            $message = new Message(
                headers: ['header-key' => 'header-value'],
                body: ['message' => 'Hello World!']
            );

            Kafka::publish('kafka')
                ->onTopic('hello-world')
                ->withMessage($message)
                ->send();

            return response()->json(['message' => 'Message successfully produced to Kafka']);
            Log::info('Message successfully produced to Kafka', ['message' => $message]);
        } catch (\Exception $e) {
            Log::error('Error producing message to Kafka', ['error' => $e->getMessage()]);
        }
    }
}
