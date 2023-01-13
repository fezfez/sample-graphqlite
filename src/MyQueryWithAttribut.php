<?php

declare(strict_types=1);

namespace Fezfez;

use TheCodingMachine\GraphQLite\Annotations\Query;

class MyQueryWithAttribut
{
    #[Query(name: 'MyQueryWithAttribut')]
    public function __invoke(): string
    {
        return 'Hello from my query';
    }
}
