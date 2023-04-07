<?php

namespace Untek\Model\Repository\Mappers;

use Untek\Model\Repository\Interfaces\MapperInterface;

class ClearEmptyMapper implements MapperInterface
{

    public function encode($entityAttributes)
    {
        $new = [];
        foreach ($entityAttributes as $name => $value) {
            if ($value !== null) {
                $new[$name] = $value;
            }
        }
        return $new;
    }

    public function decode($rowAttributes)
    {
        $new = [];
        foreach ($rowAttributes as $name => $value) {
            if ($value !== null) {
                $new[$name] = $value;
            }
        }
        return $new;
    }
}
