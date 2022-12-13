<?php

namespace ZnSandbox\Sandbox\RpcClient\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;
use ZnCore\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;
use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

class RpcClientHistoryPermissionEnum implements GetLabelsInterface, GetRbacInheritanceInterface
{

    public const CRUD = 'oRpcClientHistoryCrud';

    public const ALL = 'oRpcClientHistoryAll';

    public const ONE = 'oRpcClientHistoryOne';

    public const CREATE = 'oRpcClientHistoryCreate';

    public const UPDATE = 'oRpcClientHistoryUpdate';

    public const DELETE = 'oRpcClientHistoryDelete';

    public const RESTORE = 'oRpcClientHistoryRestore';

    public static function getLabels()
    {
        return [
            self::CRUD => 'История RPC-запросов. Полный доступ',
            self::ALL => 'История RPC-запросов. Просмотр списка',
            self::ONE => 'История RPC-запросов. Просмотр записи',
            self::CREATE => 'История RPC-запросов. Создание',
            self::UPDATE => 'История RPC-запросов. Редактирование',
            self::DELETE => 'История RPC-запросов. Удаление',
            self::RESTORE => 'История RPC-запросов. Восстановление',
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
            SystemRoleEnum::DEVELOPER => [
                self::CRUD
            ],
        ];
    }
}
