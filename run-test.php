<?php

declare(strict_types=1);

use Symfony\Component\HttpClient\HttpClient;

require __DIR__ . '/vendor/autoload.php';

$makeQuery = static function ($query, $variables): mixed {
    $client   = HttpClient::create();
    $response = $client->request('POST', 'http://web:85', [
        'body' => json_encode([
            'query' => $query,
            'variables' => $variables,
        ]),
    ]);

    return json_decode($response->getContent(), true);
};

// language=GraphQL
$introspection = '{ 
  __schema {
    mutationType {
      fields {
      	name,
      	args {
      	    name
      	}
      }
    },
    queryType {
        fields {
            name
        }    
    }
  }
}';


echo 'Introspection ...';

$introspectionResult = $makeQuery($introspection, []);

$introspectionExpectedResult = [
    'data' => [
        '__schema' => [
            'mutationType' =>  [
                'fields' => [
                    [
                        'name' => 'myCustomMutation',
                        'args' => [
                            ['name' => 'id'],
                            ['name' => 'myCustomInput'],
                        ],
                    ],
                ],
            ],
            'queryType' => [
                'fields' => [
                    ['name' => 'MyQueryWithAttribut'],
                ],
            ],
        ],
    ],
];

if (json_encode($introspectionResult) !== json_encode($introspectionResult)) {
    echo "not working!\n";
    exit;
}

echo "OK !\n";
echo 'Query...';

// language=GraphQL
$query = '
  query {
    MyQueryWithAttribut
  }
';

if (
    json_encode($makeQuery($query, [])) !== json_encode([
        'data' => ['MyQueryWithAttribut' => 'Hello from my query'],
    ])
) {
    echo "not working!\n";
    exit;
}

echo "OK !\n";

// language=GraphQL
$mutation = '
  mutation ($id: String!, $myCustomInput: MyCustomInputType!) {
    myCustomMutation(id: $id, myCustomInput: $myCustomInput)
  }
';

echo "Mutation...\n";

var_dump($makeQuery(
    $mutation,
    [
        'id' => 'myuuid',
        'myCustomInput' => [
            'user' => 'myuuid',
            'date' => '2010-10-10',
        ],
    ],
));
