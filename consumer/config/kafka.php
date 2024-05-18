<?php
declare(strict_types=1);

return [
    'brokers' => env('KAFKA_BROKERS', 'kafka:9092'),
    'consumer_group_id' => env('KAFKA_CONSUMER_GROUP_ID', 'group'),
    'auto_commit' => env('KAFKA_AUTO_COMMIT', true),

    'topic' => [
        'subscribers' => [
            'hello-world' => [
                'topic' => 'hello-world',
                'broker' => env('KAFKA_BROKERS', 'kafka:9092'),
                'partition' => 0,
                'replicas' => 1,
            ],
        ],
    ],
];
