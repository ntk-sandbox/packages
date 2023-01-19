<?php

use Fruitcake\Cors\CorsService;
use ZnLib\Components\Http\Enums\HttpMethodEnum;

return [
    'singletons' => [
        CorsService::class => function () {
            $options = [];
            if (getenv('CORS_ALLOW_ORIGINS')) {
                $options['allowedOrigins'] = explode(',', getenv('CORS_ALLOW_ORIGINS'));
            }
            if (getenv('CORS_MAX_AGE')) {
                $options['maxAge'] = (int)getenv('CORS_MAX_AGE');
            }
            if (getenv('CORS_ALLOW_HEADERS')) {
                $options['allowedHeaders'] = explode(',', getenv('CORS_ALLOW_HEADERS'));
            }
            if (getenv('CORS_ALLOW_METHODS')) {
                $options['allowedMethods'] = explode(',', getenv('CORS_ALLOW_METHODS'));
            } else {
                $options['allowedMethods'] = [HttpMethodEnum::POST];
            }
            if (getenv('CORS_SUPPORTS_CREDENTIALS')) {
                $options['supportsCredentials'] = true;
            }
            return new CorsService($options);
        }
    ],
];