<?php

namespace ZnSandbox\Sandbox\RpcMock\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;
use ZnCore\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;

class RpcMockMethodPermissionEnum implements GetLabelsInterface, GetRbacInheritanceInterface
{

    public const CRUD = 'oRpcMockMethodCrud';

    public const ALL = 'oRpcMockMethodAll';

    public const ONE = 'oRpcMockMethodOne';

    public const CREATE = 'oRpcMockMethodCreate';

    public const UPDATE = 'oRpcMockMethodUpdate';

    public const DELETE = 'oRpcMockMethodDelete';

    public const RESTORE = 'oRpcMockMethodRestore';

    public static function getLabels()
    {
        return [
            self::CRUD => 'RpcMockMethod. Полный доступ',
            self::ALL => 'RpcMockMethod. Просмотр списка',
            self::ONE => 'RpcMockMethod. Просмотр записи',
            self::CREATE => 'RpcMockMethod. Создание',
            self::UPDATE => 'RpcMockMethod. Редактирование',
            self::DELETE => 'RpcMockMethod. Удаление',
            self::RESTORE => 'RpcMockMethod. Восстановление',
        ];
    }

    public static function getInheritance()
    {
        return [
            self::CRUD => [
                self::ALL,
                self::ONE,
                self::CREATE,
                self::UPDATE,
                self::DELETE,
                self::RESTORE,
            ],
        ];
    }


}

