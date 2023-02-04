<?php

return [
    [
        'method_name' => 'application.all',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => 'oApplicationApplicationAll',
        'handler_class' => 'Untek\Sandbox\Sandbox\Application\Rpc\Controllers\ApplicationController',
        'handler_method' => 'all',
        'status_id' => 100,
        'title' => 'Получить список приложений',
        'description' => null,
        /*'example' => [
            'request' => [

            ],
            'response' => [

            ],
        ],*/
    ],
    [
        'method_name' => 'application.oneById',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => 'oApplicationApplicationOne',
        'handler_class' => 'Untek\Sandbox\Sandbox\Application\Rpc\Controllers\ApplicationController',
        'handler_method' => 'oneById',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'application.create',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => 'oApplicationApplicationCreate',
        'handler_class' => 'Untek\Sandbox\Sandbox\Application\Rpc\Controllers\ApplicationController',
        'handler_method' => 'add',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'application.update',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => 'oApplicationApplicationUpdate',
        'handler_class' => 'Untek\Sandbox\Sandbox\Application\Rpc\Controllers\ApplicationController',
        'handler_method' => 'update',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'application.delete',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => 'oApplicationApplicationDelete',
        'handler_class' => 'Untek\Sandbox\Sandbox\Application\Rpc\Controllers\ApplicationController',
        'handler_method' => 'delete',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
];