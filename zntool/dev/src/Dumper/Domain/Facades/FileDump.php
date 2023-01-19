<?php

namespace ZnTool\Dev\Dumper\Domain\Facades;

use ZnCore\FileSystem\Helpers\FileStorageHelper;

class FileDump
{

    private static $id = 1;

    public static function dump($value)
    {
        $json = json_encode($value, JSON_PRETTY_PRINT);
        $fileName = getenv('VAR_DIRECTORY') . '/dump/' . date('Y.m.d') . '/'.date('H:i:s').'_' . self::$id . '.json';
        FileStorageHelper::save($fileName, $json);
        self::$id++;
    }
}
