<?php

namespace ZnDatabase\Base\Domain\Helpers;

use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\DotEnv\Domain\Libs\DotEnv;
use ZnDatabase\Base\Domain\Enums\DbDriverEnum;

class SqlHelper
{

    public static function generateRawTableName(string $tableName): string {
        $items = explode('.', $tableName);
        return '"' . implode('"."', $items) . '"';
    }

    public static function isHasSchemaInTableName(string $tableName): bool {
        return strpos($tableName, '.') !== false;
    }

    public static function extractSchemaFormTableName(string $tableName): string {
        $tableName = str_replace('"', '', $tableName);
        return explode('.', $tableName)[0];
    }

}