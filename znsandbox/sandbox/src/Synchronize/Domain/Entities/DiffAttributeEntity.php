<?php

namespace ZnSandbox\Sandbox\Synchronize\Domain\Entities;

class DiffAttributeEntity
{

    private $name;
    private $fromValue;
    private $toValue;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

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
}
