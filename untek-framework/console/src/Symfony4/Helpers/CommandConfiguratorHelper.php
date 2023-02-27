<?php

namespace Untek\Framework\Console\Symfony4\Helpers;

use Untek\Core\Code\Helpers\ComposerHelper;
use Untek\Core\FileSystem\Helpers\FindFileHelper;

class CommandConfiguratorHelper
{

    /**
     * @param string $namespace
     * @return string[] | array
     */
    public static function scanCommandsByNamespace(string $namespace): array
    {
        $files = CommandConfiguratorHelper::scanByNamespace($namespace);
        $commands = CommandConfiguratorHelper::forgeFullClassNames($files, $namespace);
        return $commands;
    }

    protected static function scanByNamespace(string $namespace): array
    {
        $path = ComposerHelper::getPsr4Path($namespace);
        $files = FindFileHelper::scanDir($path);
        $files = array_filter(
            $files,
            function ($value) {
                return preg_match('/\.php$/i', $value);
            }
        );
        return $files;
    }

    protected static function forgeFullClassNames(array $files, string $namespace): array
    {
        $commands = array_map(
            function ($classNameWithExt) use ($namespace) {
                $className = str_replace('.php', '', $classNameWithExt);
                return $namespace . '\\' . $className;
            },
            $files
        );
        return $commands;
    }
}
