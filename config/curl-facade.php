<?php

return [
    'connections' => [
        'mock_api' => [
            'base_url' => env('MOCK_API_URL', 'https://6a2912e8f59cb8f65f1c674f.mockapi.io/api/v1'),
        ],
        'jsonplaceholder' => [
            'base_url' => env('JSON_API_URL', 'https://jsonplaceholder.typicode.com/posts'),
        ],
    ],
];
