<?php

namespace Untek\Tool\Phar\Domain\Helpers;

use Untek\Core\FileSystem\Helpers\FilePathHelper;
use Untek\Component\FormatAdapter\StoreFile;

class PharHelper
{

    public static function loadAllConfig(): array
    {
        $config = null;
        if (getenv('PHAR_CONFIG_FILE') && file_exists(getenv('PHAR_CONFIG_FILE'))) {
            $store = new StoreFile(getenv('PHAR_CONFIG_FILE'));
            $config = $store->load();
        }
        return $config;
    }

    public static function loadConfig($profileName = null): array
    {
        $config = null;
        if (getenv('PHAR_CONFIG_FILE') && file_exists(getenv('PHAR_CONFIG_FILE'))) {
            $store = new StoreFile(getenv('PHAR_CONFIG_FILE'));
            $config = $store->load();
        }
        if (isset($config['profiles'][$profileName])) {
            return $config['profiles'][$profileName];
        }
    }
}