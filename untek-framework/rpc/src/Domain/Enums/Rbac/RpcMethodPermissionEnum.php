<?php

namespace Untek\Framework\Rpc\Domain\Enums\Rbac;

use Untek\Core\Enum\Interfaces\GetLabelsInterface;
use Untek\Core\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;

class RpcMethodPermissionEnum implements GetLabelsInterface, GetRbacInheritanceInterface
{

    public const CRUD = 'oRpcMethodCrud';

    public const ALL = 'oRpcMethodAll';

    public const ONE = 'oRpcMethodOne';

    public const CREATE = 'oRpcMethodCreate';

    public const UPDATE = 'oRpcMethodUpdate';

    public const DELETE = 'oRpcMethodDelete';

    public const RESTORE = 'oRpcMethodRestore';

    public static function getLabels()
    {
        return [
            self::CRUD => 'RpcMethod. Полный доступ',
            self::ALL => 'RpcMethod. Просмотр списка',
            self::ONE => 'RpcMethod. Просмотр записи',
            self::CREATE => 'RpcMethod. Создание',
            self::UPDATE => 'RpcMethod. Редактирование',
            self::DELETE => 'RpcMethod. Удаление',
            self::RESTORE => 'RpcMethod. Восстановление',
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

