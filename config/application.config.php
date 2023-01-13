<?php

declare(strict_types=1);

return [
    'modules' => [
        'Laminas\Cache',
        'Laminas\Router',
    ],
    'module_listener_options' => [
        'config_glob_paths' => [
            __DIR__ . '/config.php',
        ],
    ],
];
