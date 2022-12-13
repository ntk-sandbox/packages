<?php

namespace ZnSandbox\Sandbox\RpcMock\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;

class RpcMockHandleMethodPermissionEnum implements GetLabelsInterface
{

    public const HANDLE = 'oRpcMockHandleMethod';

    public static function getLabels()
    {
        return [
            self::HANDLE => 'RPC-метод',
        ];
    }
}
