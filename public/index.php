<?php

declare(strict_types=1);

use Fezfez\MyCustomMutationProvider;
use GraphQL\Error\DebugFlag;
use GraphQL\GraphQL;
use Laminas\Cache\Psr\SimpleCache\SimpleCacheDecorator;
use Laminas\Cache\Storage\Adapter\Memory;
use TheCodingMachine\GraphQLite\Context\Context;
use TheCodingMachine\GraphQLite\SchemaFactory;

require __DIR__ . '/../vendor/autoload.php';


$application = Laminas\Mvc\Application::init(require __DIR__ . '/../config/application.config.php');
$services    = $application->getServiceManager();

$factory = new SchemaFactory(new SimpleCacheDecorator(new Memory()), $services);

$factory = $factory->addQueryProvider(new MyCustomMutationProvider());
$factory = $factory->addControllerNamespace('Fezfez\\');
$factory = $factory->addTypeNamespace('Fezfez\\');
$factory = $factory->setGlobTTL(0);

$schema = $factory->createSchema();

$rawInput       = file_get_contents('php://input');
$input          = json_decode($rawInput, true);
$input          = is_array($input) ? $input : [];
$query          = array_key_exists('query', $input) ? $input['query'] : null;
$variableValues = array_key_exists('variables', $input) ? $input['variables'] : null;

header('Content-Type: application/json');

try {
    $result = GraphQL::executeQuery($schema, $query, null, new Context(), $variableValues);
    $output = $result->toArray(DebugFlag::RETHROW_UNSAFE_EXCEPTIONS);
} catch (Throwable $exception) {
    echo json_encode($exception->getMessage());
    exit;
}

echo json_encode($output);
