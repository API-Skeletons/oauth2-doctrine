<?php

return [
    'api-tools-mvc-auth' => [
        'authentication' => [
            'adapters' => [
                'oauth2_doctrine' => [
                    'adapter' => 'Laminas\\ApiTools\\MvcAuth\\Authentication\\OAuth2Adapter',
                    'storage' => [
                        'storage' => 'oauth2.doctrineadapter.default',
                    ],
                ],
            ],
            'map' => [
                'Api\\V1' => 'oauth2_doctrine',
            ],
        ],
    ],

    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\SQLite3\Driver',
                'params' => [
                    'memory' => 'true',
                ],
            ],
        ],
    ],
];
