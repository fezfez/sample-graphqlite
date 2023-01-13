<?php

declare(strict_types=1);

namespace Fezfez;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

class MyCustomInputType extends InputObjectType
{
    private static self|null $instance = null;

    public function __construct()
    {
        parent::__construct([
            'name' => 'MyCustomInputType',
            'fields' => [
                'user' => [
                    'type' => Type::nonNull(Type::string()),
                ],
                'date' => [
                    'type' => Type::nonNull(Type::string()),
                ],
            ],
        ]);
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
