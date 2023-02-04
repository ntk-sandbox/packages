<?php

namespace Untek\Sandbox\Sandbox\Generator\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Domain\Validator\Interfaces\ValidationByMetadataInterface;
use Untek\Domain\Entity\Interfaces\UniqueInterface;

class AttributeEntity implements ValidationByMetadataInterface, UniqueInterface
{

    private $name = null;

    private $type = null;

    private $length = null;

    private $nullable = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new Assert\NotBlank);
        $metadata->addPropertyConstraint('type', new Assert\NotBlank);
    }

    public function unique() : array
    {
        return [];
    }

    public function setName($value) : void
    {
        $this->name = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setType($value) : void
    {
        $this->type = $value;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function setLength($length): void
    {
        $this->length = $length;
    }

    public function getNullable()
    {
        return $this->nullable;
    }

    public function setNullable($nullable): void
    {
        $this->nullable = $nullable;
    }

}

