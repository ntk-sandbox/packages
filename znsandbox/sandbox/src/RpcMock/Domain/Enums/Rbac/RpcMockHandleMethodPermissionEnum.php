<?php

namespace Untek\Sandbox\Sandbox\RpcMock\Domain\Enums\Rbac;

use Untek\Core\Enum\Interfaces\GetLabelsInterface;

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
