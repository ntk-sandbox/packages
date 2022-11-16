<?php

namespace ZnDatabase\Eloquent\Domain\Libs\ConfigBuilders;

use ZnCore\Code\Helpers\DeprecateHelper;

DeprecateHelper::hardThrow();

class EloquentConfigBuilder
{

    public static function build(array $connection) {
        return $connection;
    }
}
