<?php

namespace ZnSandbox\Sandbox\RpcClient\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;
use ZnCore\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;
use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

class RpcClientFavoritePermissionEnum implements GetLabelsInterface, GetRbacInheritanceInterface
{

    public const CRUD = 'oRpcClientFavoriteCrud';

    public const ALL = 'oRpcClientFavoriteAll';

    public const ONE = 'oRpcClientFavoriteOne';

    public const CREATE = 'oRpcClientFavoriteCreate';

    public const UPDATE = 'oRpcClientFavoriteUpdate';

    public const DELETE = 'oRpcClientFavoriteDelete';

    public const RESTORE = 'oRpcClientFavoriteRestore';

    public static function getLabels()
    {
        return [
            self::CRUD => 'Избранные RPC-запросы. Полный доступ',
            self::ALL => 'Избранные RPC-запросы. Просмотр списка',
            self::ONE => 'Избранные RPC-запросы. Просмотр записи',
            self::CREATE => 'Избранные RPC-запросы. Создание',
            self::UPDATE => 'Избранные RPC-запросы. Редактирование',
            self::DELETE => 'Избранные RPC-запросы. Удаление',
            self::RESTORE => 'Избранные RPC-запросы. Восстановление',
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
