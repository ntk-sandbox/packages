<?php

use Fruitcake\Cors\CorsService;
use Untek\Lib\Components\Http\Enums\HttpMethodEnum;

return [
    'singletons' => [
        CorsService::class => function (\Psr\Container\ContainerInterface $container) {
            /** @var \Untek\Core\App\Interfaces\EnvStorageInterface $envStorage */
            $envStorage = $container->get(\Untek\Core\App\Interfaces\EnvStorageInterface::class);

            $options = [];
            if ($envStorage->get('CORS_ALLOW_ORIGINS')) {
                $options['allowedOrigins'] = explode(',', $envStorage->get('CORS_ALLOW_ORIGINS'));
            }
            if ($envStorage->get('CORS_MAX_AGE')) {
                $options['maxAge'] = (int)$envStorage->get('CORS_MAX_AGE');
            }
            if ($envStorage->get('CORS_ALLOW_HEADERS')) {
                $options['allowedHeaders'] = explode(',', $envStorage->get('CORS_ALLOW_HEADERS'));
            }
            if ($envStorage->get('CORS_ALLOW_METHODS')) {
                $options['allowedMethods'] = explode(',', $envStorage->get('CORS_ALLOW_METHODS'));
            } else {
                $options['allowedMethods'] = [HttpMethodEnum::POST];
            }
            if ($envStorage->get('CORS_SUPPORTS_CREDENTIALS')) {
                $options['supportsCredentials'] = true;
            }
            return new CorsService($options);
        }
    ],
];