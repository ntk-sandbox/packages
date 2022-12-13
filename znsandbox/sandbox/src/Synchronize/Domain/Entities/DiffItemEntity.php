<?php

namespace ZnSandbox\Sandbox\Synchronize\Domain\Entities;

use ZnCore\Collection\Interfaces\Enumerable;

class DiffItemEntity
{

    private $index;
//    private $name;
    private $fromValue;
    private $toValue;
    private $attributes = [];

    public function getIndex()
    {
        return $this->index;
    }

    public function setIndex($index): void
    {
        $this->index = $index;
    }

    /*public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }*/

    public function getFromValue()
    {
        return $this->fromValue;
    }

    public function setFromValue($fromValue): void
    {
        $this->fromValue = $fromValue;
    }

    public function getToValue()
    {
        return $this->toValue;
    }

    public function setToValue($toValue): void
    {
        $this->toValue = $toValue;
    }

    /**
     * @return Enumerable | DiffAttributeEntity[]
     */
    public function getAttributes(): Enumerable
    {
        return $this->attributes;
    }

    public function setAttributes(Enumerable $attributes): void
    {
        $this->attributes = $attributes;
    }

}
