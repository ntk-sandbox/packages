<?php

namespace ZnUser\Rbac\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use ZnDomain\Entity\Interfaces\UniqueInterface;
use ZnDomain\Entity\Interfaces\EntityIdInterface;

class InheritanceEntity implements ValidationByMetadataInterface, UniqueInterface, EntityIdInterface
{

    private $id = null;

    private $parentName = null;

    private $childName = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('id', new Assert\NotBlank);
        $metadata->addPropertyConstraint('parentName', new Assert\NotBlank);
        $metadata->addPropertyConstraint('childName', new Assert\NotBlank);
    }

    public function unique() : array
    {
        return [];
    }

    public function setId($value) : void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setParentName($value) : void
    {
        $this->parentName = $value;
    }

    public function getParentName()
    {
        return $this->parentName;
    }

    public function setChildName($value) : void
    {
        $this->childName = $value;
    }

    public function getChildName()
    {
        return $this->childName;
    }

}
