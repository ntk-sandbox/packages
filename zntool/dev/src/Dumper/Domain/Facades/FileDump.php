<?php

namespace ZnTool\Dev\Dumper\Domain\Facades;

use ZnCore\FileSystem\Helpers\FileStorageHelper;

class FileDump
{

    public static function dump($value) {
        FileStorageHelper::save(getenv('VAR_DIRECTORY') . '/dump.json', json_encode($value, JSON_PRETTY_PRINT));
//        file_put_contents(getenv('VAR_DIRECTORY') . '/111.json', json_encode($value, JSON_PRETTY_PRINT));
    }
}
