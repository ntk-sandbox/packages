<?php

namespace Untek\Framework\Rpc\Domain\Enums\Rbac;

use Untek\Core\Enum\Interfaces\GetLabelsInterface;

class FixturePermissionEnum implements GetLabelsInterface
{

    const FIXTURE_IMPORT = 'oFixtureImport';

    public static function getLabels()
    {
        return [
            self::FIXTURE_IMPORT => 'Фикстуры. Импорт',
        ];
    }
}