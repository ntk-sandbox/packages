<?php

namespace ZnTool\Dev\VarDumper\Dumper;

use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;
use ZnCore\FileSystem\Helpers\FileStorageHelper;

class JsonDumper implements DataDumperInterface
{

    public function __construct(private string $directory)
    {
    }

    public function dump(Data $data, $output = null)
    {
        $value = $data->getValue(true);
        $value = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        $fileName = $this->directory . '/' . (microtime(true) * 1000) . '.json';
        FileStorageHelper::save($fileName, $value);
    }
}
