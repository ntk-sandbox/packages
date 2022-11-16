<?php

return [
    'singletons' => [
        'ZnFramework\\Rpc\\Domain\\Interfaces\\Services\\ProcedureServiceInterface' => 'ZnFramework\\Rpc\\Domain\\Services\\ProcedureService',
        'ZnFramework\\Rpc\\Domain\\Interfaces\\Encoders\\RequestEncoderInterface' => 'ZnFramework\\Rpc\\Domain\\Encoders\\RequestEncoder',
        'ZnFramework\\Rpc\\Domain\\Interfaces\\Encoders\\ResponseEncoderInterface' => 'ZnFramework\\Rpc\\Domain\\Encoders\\ResponseEncoder',
        'ZnFramework\\Rpc\\Domain\\Interfaces\\Services\\MethodServiceInterface' => 'ZnFramework\\Rpc\\Domain\\Services\\MethodService',
        'ZnFramework\\Rpc\\Domain\\Interfaces\\Services\\DocsServiceInterface' => 'ZnFramework\\Rpc\\Domain\\Services\\DocsService',
        'ZnFramework\\Rpc\\Domain\\Interfaces\\Services\\VersionHandlerServiceInterface' => 'ZnFramework\\Rpc\\Domain\\Services\\VersionHandlerService',
        'ZnFramework\\Rpc\\Domain\\Interfaces\\Repositories\\VersionHandlerRepositoryInterface' => 'ZnFramework\\Rpc\\Domain\\Repositories\\Eloquent\\VersionHandlerRepository',
//        'ZnFramework\\Rpc\\Symfony4\\Web\\Controllers\\DocsController' => 'ZnFramework\\Rpc\\Symfony4\\Web\\Controllers\\DocsController',
        'ZnFramework\\Rpc\\Domain\\Interfaces\\Repositories\\DocsRepositoryInterface' => 'ZnFramework\\Rpc\\Domain\\Repositories\\File\\DocsRepository',
        'ZnFramework\\Rpc\\Domain\\Interfaces\\Services\\SettingsServiceInterface' => 'ZnFramework\\Rpc\\Domain\\Services\\SettingsService',
    ],
    /*'entities' => [
        'ZnFramework\\Rpc\\Domain\\Entities\\MethodEntity' => 'ZnFramework\\Rpc\\Domain\\Interfaces\\Repositories\\MethodRepositoryInterface',
        'ZnFramework\\Rpc\\Domain\\Entities\\VersionHandlerEntity' => 'ZnFramework\\Rpc\\Domain\\Interfaces\\Repositories\\VersionHandlerRepositoryInterface',
    ],*/
];