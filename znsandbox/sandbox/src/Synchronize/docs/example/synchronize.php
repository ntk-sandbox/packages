<?php

use ZnUser\Rbac\Domain\Enums\RbacCacheEnum;

return [
    [
        'tableName' => 'reference_book',
        'uniqueAttributes' => ['id'],
        'updateAttributes' => [],
    ],
    [
        'tableName' => 'reference_item',
        'uniqueAttributes' => ['id'],
        'updateAttributes' => [],
    ],
    [
        'tableName' => 'rbac_item',
        'uniqueAttributes' => ['name'],
        'updateAttributes' => ['type', 'name', 'title', 'description'],
        'titleAttributes' => ['name', 'title'],
        'clearCache' => [
            RbacCacheEnum::ENFORCER
        ],
    ],
    [
        'tableName' => 'rbac_inheritance',
        'uniqueAttributes' => ['parent_name', 'child_name'],
        'updateAttributes' => ['parent_name', 'child_name'],
        'titleAttributes' => ['parent_name', 'child_name'],
        'clearCache' => [
            RbacCacheEnum::ENFORCER
        ],
    ],
    [
        'tableName' => 'rpc_route',
        'uniqueAttributes' => ['method_name', 'version'],
        'updateAttributes' => [
            'method_name',
            'version',
            'is_verify_eds',
            'is_verify_auth',
            'permission_name',
            'handler_class',
            'handler_method',
            'status_id',
        ],
    ],
];