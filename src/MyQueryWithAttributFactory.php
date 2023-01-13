<?php

declare(strict_types=1);

namespace Fezfez;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

final class MyQueryWithAttributFactory implements FactoryInterface
{
    /** @inheritDoc */
    public function __invoke(ContainerInterface $container, $requestedName, array|null $options = null): MyQueryWithAttribut
    {
        return new MyQueryWithAttribut();
    }
}
