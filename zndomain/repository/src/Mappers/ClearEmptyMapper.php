<?php

namespace Untek\Domain\Repository\Mappers;

use Untek\Domain\Repository\Interfaces\MapperInterface;

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
