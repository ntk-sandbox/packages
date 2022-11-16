<?php

namespace ZnSandbox\Sandbox\Generator\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use ZnDomain\Entity\Interfaces\UniqueInterface;
use ZnSandbox\Sandbox\Bundle\Domain\Entities\DomainEntity;

class ServiceEntity extends ClassEntity implements ValidationByMetadataInterface, UniqueInterface
{

    private $name = null;

    private $entity = null;

    private $domain = null;

    private $class = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('entity', new Assert\NotBlank);
        $metadata->addPropertyConstraint('domain', new Assert\NotBlank);
    }

    public function unique() : array
    {
        return [];
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getEntity(): EntityEntity
    {
        return $this->entity;
    }

    public function setEntity(EntityEntity $entity): void
    {
        $this->entity = $entity;
    }

    public function setDomain(DomainEntity $value) : void
    {
        $this->domain = $value;
    }

    public function getDomain(): DomainEntity
    {
        return $this->domain;
    }

    public function getClass(): ClassEntity
    {
        return $this->class;
    }

    public function setClass(ClassEntity $class): void
    {
        $this->class = $class;
    }

}

