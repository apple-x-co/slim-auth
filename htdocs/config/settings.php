<?php
return [
    'settings' => [
        'debug'                             => (bool)getenv('DEBUG'),
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails'               => (bool)getenv('DISPLAY_ERRORS'), // set to false in production
        'addContentLengthHeader'            => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer'                          => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // View settings
        'view'                              => [
            'template_path' => __DIR__ . '/../templates/',
            'twig'          => [
                'cache'       => __DIR__ . '/../cache/templates/',
                'debug'       => (bool)getenv('DEBUG'),
                'auto_reload' => true,
            ],
        ],

        // Monolog settings
        'logger'                            => [
            'name'  => 'slim-app',
            'path'  => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => (bool)getenv('DEBUG') ? \Monolog\Logger::DEBUG : \Monolog\Logger::ERROR,
        ],
    ],
];
