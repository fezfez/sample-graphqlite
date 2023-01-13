<?php

declare(strict_types=1);

namespace Fezfez;

use GraphQL\Type\Definition\FieldDefinition;
use GraphQL\Type\Definition\Type;
use TheCodingMachine\GraphQLite\QueryField;
use TheCodingMachine\GraphQLite\QueryProviderInterface;

use function json_encode;

class MyCustomMutationProvider implements QueryProviderInterface
{
    /** @return QueryField[] */
    public function getQueries(): array
    {
        return [];
    }

    /** @return FieldDefinition[] */
    public function getMutations(): array
    {
        return [
            FieldDefinition::create([
                'description' => 'my custom mutation',
                'name' => 'myCustomMutation',
                'args' => [
                    ['name' => 'id', 'type' => Type::nonNull(Type::string())],
                    ['name' => 'myCustomInput', 'type' => Type::nonNull(MyCustomInputType::getInstance())],
                ],
                'type' => Type::nonNull(Type::boolean()),
                'resolve' => static function ($rootValue, $args): string {
                    return json_encode($args);
                },
            ]),
        ];
    }
}
