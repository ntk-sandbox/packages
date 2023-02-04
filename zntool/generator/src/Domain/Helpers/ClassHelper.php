<?php

namespace Untek\Tool\Generator\Domain\Helpers;

use Untek\Core\FileSystem\Helpers\FileStorageHelper;
use Untek\Tool\Package\Domain\Helpers\PackageHelper;

class ClassHelper
{

    public static function generateFile(string $alias, string $code)
    {
        $fileName = PackageHelper::pathByNamespace($alias);
        FileStorageHelper::save($fileName . '.php', $code);
    }
}
