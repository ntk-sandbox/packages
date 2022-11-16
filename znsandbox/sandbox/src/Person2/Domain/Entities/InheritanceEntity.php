<?php

namespace ZnSandbox\Sandbox\Person2\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnLib\Components\Status\Enums\StatusEnum;
use ZnDomain\Components\Constraints\Enum;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use ZnDomain\Entity\Interfaces\UniqueInterface;
use ZnDomain\Entity\Interfaces\EntityIdInterface;

class InheritanceEntity implements ValidationByMetadataInterface, UniqueInterface, EntityIdInterface
{

    private $id = null;

    private $childPersonId = null;

    private $parentPersonId = null;

    private $statusId = StatusEnum::ENABLED;

    private $childPerson = null;

    private $parentPerson = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('childPersonId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('parentPersonId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusEnum::class,
        ]));
    }

    public function unique() : array
    {
        return [
            ['child_person_id', 'parent_person_id'],
        ];
    }

    public function setId($value) : void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setChildPersonId($value) : void
    {
        $this->childPersonId = $value;
    }

    public function getChildPersonId()
    {
        return $this->childPersonId;
    }

    public function setParentPersonId($value) : void
    {
        $this->parentPersonId = $value;
    }

    public function getParentPersonId()
    {
        return $this->parentPersonId;
    }

    public function setStatusId($value) : void
    {
        $this->statusId = $value;
    }

    public function getStatusId()
    {
        return $this->statusId;
    }

    public function getChildPerson()
    {
        return $this->childPerson;
    }

    public function setChildPerson($childPerson): void
    {
        $this->childPerson = $childPerson;
    }

    public function getParentPerson()
    {
        return $this->parentPerson;
    }

    public function setParentPerson($parentPerson): void
    {
        $this->parentPerson = $parentPerson;
    }
}
