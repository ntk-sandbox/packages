<?php

use Fruitcake\Cors\CorsService;
use ZnLib\Components\Http\Enums\HttpMethodEnum;

return [
    'singletons' => [
        CorsService::class => function () {
            $options = [];
            if (!empty($_ENV['CORS_ALLOW_ORIGINS'])) {
                $options['allowedOrigins'] = explode(',', $_ENV['CORS_ALLOW_ORIGINS']);
            }
            if (!empty($_ENV['CORS_MAX_AGE'])) {
                $options['maxAge'] = (int)$_ENV['CORS_MAX_AGE'];
            }
            if (!empty($_ENV['CORS_ALLOW_HEADERS'])) {
                $options['allowedHeaders'] = explode(',', $_ENV['CORS_ALLOW_HEADERS']);
            }
            if (!empty($_ENV['CORS_ALLOW_METHODS'])) {
                $options['allowedMethods'] = explode(',', $_ENV['CORS_ALLOW_METHODS']);
            } else {
                $options['allowedMethods'] = [HttpMethodEnum::POST];
            }
            if (!empty($_ENV['CORS_SUPPORTS_CREDENTIALS'])) {
                $options['supportsCredentials'] = true;
            }
            return new CorsService($options);
        }
    ],
];