<?php

namespace ZnBundle\Log;

use ZnBundle\Log\Domain\Entities\LogEntity;
use ZnCore\Code\Helpers\PropertyHelper;
use ZnCore\Collection\Libs\Collection;

class JsonRepository
{

    public function findAll()
    {
        $env = getenv('APP_ENV');
        $logFileName = __DIR__ . '/../../../../../' . $env . '.json';
        $lines = file($logFileName, \FILE_IGNORE_NEW_LINES);
        $collection = new Collection();
        foreach ($lines as &$line) {
            $line = json_decode($line);
            $logEntity = new LogEntity();
            PropertyHelper::setAttributes($logEntity, $line);
            $collection->add($logEntity);
        }
        return $collection;
    }

}
