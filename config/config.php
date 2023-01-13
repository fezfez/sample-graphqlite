<?php

declare(strict_types=1);

use Fezfez\MyQueryWithAttribut;
use Fezfez\MyQueryWithAttributFactory;

return [
    'service_manager' => [
        'factories' => [
            MyQueryWithAttribut::class => MyQueryWithAttributFactory::class,
        ],
    ],
];
