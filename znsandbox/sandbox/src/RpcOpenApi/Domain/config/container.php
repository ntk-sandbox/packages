<?php

use Untek\Sandbox\Sandbox\RpcOpenApi\Domain\Libs\OpenApi3\OpenApi3;

return [
	'singletons' => [
	    OpenApi3::class => function(\Psr\Container\ContainerInterface $container) {
            /** @var \Untek\Core\App\Interfaces\EnvStorageInterface $envStorage */
            $envStorage = $container->get(\Untek\Core\App\Interfaces\EnvStorageInterface::class);

            return new OpenApi3($envStorage->get('OPEN_API_RPC_SOURCE_DIRECTORY'));
        }
	],
];