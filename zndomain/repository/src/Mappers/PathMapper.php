<?php

namespace Untek\Domain\Repository\Mappers;

use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Domain\Repository\Interfaces\MapperInterface;

class PathMapper implements MapperInterface
{

    private $map;
    private $isRemoveOldValue;

    public function __construct(array $map, bool $isRemoveOldValue = true)
    {
        $this->map = $map;
        $this->isRemoveOldValue = $isRemoveOldValue;
    }

    public function encode($rowAttributes)
    {
        foreach ($this->map as $fromPath => $toPath) {
            $value = ArrayHelper::getValue($rowAttributes, $fromPath);
            ArrayHelper::setValue($rowAttributes, $toPath, $value);
            if ($this->isRemoveOldValue) {
                ArrayHelper::removeItem($rowAttributes, $fromPath);
            }
        }
        return $rowAttributes;
    }

    public function decode($rowAttributes)
    {
        foreach ($this->map as $toPath => $fromPath) {
            $value = ArrayHelper::getValue($rowAttributes, $fromPath);
            ArrayHelper::setValue($rowAttributes, $toPath, $value);
            if ($this->isRemoveOldValue) {
                ArrayHelper::removeItem($rowAttributes, $fromPath);
            }
        }
        return $rowAttributes;
    }
}
