<?php

namespace ZnDomain\Repository\Libs;

use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\Code\Helpers\PropertyHelper;
use ZnCore\Collection\Libs\Collection;
use ZnCore\Instance\Helpers\ClassHelper;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnDomain\Repository\Interfaces\MapperInterface;
use ZnLib\Components\Format\Encoders\ChainEncoder;

class MapperEncoder //implements MapperInterface
{

    private $mappers;

    public function __construct(array $mappers)
    {
        $this->mappers = $mappers;
    }

    public function encode($attributes)
    {
        $mappers = $this->mappers;
        if ($mappers) {
            $encoders = new ChainEncoder(new Collection($mappers));
            $attributes = $encoders->encode($attributes);
        }
        return $attributes;
    }

    public function decode($array)
    {
        $mappers = $this->mappers;
        if ($mappers) {
            $mappers = array_reverse($mappers);
            $encoders = new ChainEncoder(new Collection($mappers));
            $array = $encoders->decode($array);
        }
        return $array;
    }
}
