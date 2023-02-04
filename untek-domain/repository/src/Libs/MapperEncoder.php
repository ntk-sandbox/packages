<?php

namespace Untek\Domain\Repository\Libs;

use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Core\Code\Helpers\PropertyHelper;
use Untek\Core\Collection\Libs\Collection;
use Untek\Core\Instance\Helpers\ClassHelper;
use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\Domain\Repository\Interfaces\MapperInterface;
use Untek\Lib\Components\Format\Encoders\ChainEncoder;

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
