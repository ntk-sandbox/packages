<?php

return [
    'singletons' => [
        'Untek\\Framework\\Rpc\\Domain\\Interfaces\\Services\\ProcedureServiceInterface' => 'Untek\\Framework\\Rpc\\Domain\\Services\\ProcedureService',
        'Untek\\Framework\\Rpc\\Domain\\Interfaces\\Encoders\\RequestEncoderInterface' => 'Untek\\Framework\\Rpc\\Domain\\Encoders\\RequestEncoder',
        'Untek\\Framework\\Rpc\\Domain\\Interfaces\\Encoders\\ResponseEncoderInterface' => 'Untek\\Framework\\Rpc\\Domain\\Encoders\\ResponseEncoder',
        'Untek\\Framework\\Rpc\\Domain\\Interfaces\\Services\\MethodServiceInterface' => 'Untek\\Framework\\Rpc\\Domain\\Services\\MethodService',
        'Untek\\Framework\\Rpc\\Domain\\Interfaces\\Services\\DocsServiceInterface' => 'Untek\\Framework\\Rpc\\Domain\\Services\\DocsService',
        'Untek\\Framework\\Rpc\\Domain\\Interfaces\\Services\\VersionHandlerServiceInterface' => 'Untek\\Framework\\Rpc\\Domain\\Services\\VersionHandlerService',
        'Untek\\Framework\\Rpc\\Domain\\Interfaces\\Repositories\\VersionHandlerRepositoryInterface' => 'Untek\\Framework\\Rpc\\Domain\\Repositories\\Eloquent\\VersionHandlerRepository',
//        'Untek\\Framework\\Rpc\\Symfony4\\Web\\Controllers\\DocsController' => 'Untek\\Framework\\Rpc\\Symfony4\\Web\\Controllers\\DocsController',
        'Untek\\Framework\\Rpc\\Domain\\Interfaces\\Repositories\\DocsRepositoryInterface' => 'Untek\\Framework\\Rpc\\Domain\\Repositories\\File\\DocsRepository',
        'Untek\\Framework\\Rpc\\Domain\\Interfaces\\Services\\SettingsServiceInterface' => 'Untek\\Framework\\Rpc\\Domain\\Services\\SettingsService',
    ],
];