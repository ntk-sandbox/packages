<?php

namespace ZnDatabase\Base\Domain\Libs;

use ZnCore\Arr\Helpers\ArrayHelper;

class TableAlias
{

    private $map = null;
    private $connectionMaps = [];

    public function addMap(string $connectionName, array $map)
    {
        $this->connectionMaps[$connectionName] = $map;
    }

    public function encode(string $connectionName, string $sourceTableName)
    {
        $map = $this->connectionMaps[$connectionName];
        $targetTableName = ArrayHelper::getValue($map, $sourceTableName, $sourceTableName);
        return $targetTableName;
    }

    public function decode(string $connectionName, string $targetTableName)
    {
        $map = $this->connectionMaps[$connectionName];
        $map = array_flip($map);
        $sourceTableName = ArrayHelper::getValue($map, $targetTableName, $targetTableName);
        return $sourceTableName;
    }

}