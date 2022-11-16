<?php

namespace ZnSandbox\Sandbox\RpcClient\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;
use ZnCore\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;
use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

class RpcClientRequestPermissionEnum implements GetLabelsInterface, GetRbacInheritanceInterface
{

    public const CRUD = 'oRpcClientRequestCrud';

    public const SEND = 'oRpcClientRequestSend';



    /*public const ALL = 'oRpcClientRequestAll';

    public const ONE = 'oRpcClientRequestOne';

    public const CREATE = 'oRpcClientRequestCreate';

    public const UPDATE = 'oRpcClientRequestUpdate';

    public const DELETE = 'oRpcClientRequestDelete';

    public const RESTORE = 'oRpcClientRequestRestore';*/

    public static function getLabels()
    {
        return [
            self::CRUD => 'RPC-запрос. Полный доступ',
            self::SEND => 'RPC-запрос. Отправка запроса',
            /*self::ALL => 'RPC-запрос. Просмотр списка',
            self::ONE => 'RPC-запрос. Просмотр записи',
            self::CREATE => 'RPC-запрос. Создание',
            self::UPDATE => 'RPC-запрос. Редактирование',
            self::DELETE => 'RPC-запрос. Удаление',
            self::RESTORE => 'RPC-запрос. Восстановление',*/
        ];
    }

    public static function getInheritance()
    {
        return [
            self::CRUD => [
                self::SEND,
                /*self::ALL,
                self::ONE,
                self::CREATE,
                self::UPDATE,
                self::DELETE,
                self::RESTORE,*/
            ],
            SystemRoleEnum::DEVELOPER => [
                self::CRUD
            ],
        ];
    }
}
