<?php

return [
    'request' => [
        'response' => [
            'message' => [
                'name' => env('REQUEST_RESPONSE_MESSAGE_NAME', 'Gateway.Response'),
            ],
        ],
        'message' => [
            'name' => env('REQUEST_MESSAGE_NAME', 'Gateway.Request'),
        ],
    ],
];
