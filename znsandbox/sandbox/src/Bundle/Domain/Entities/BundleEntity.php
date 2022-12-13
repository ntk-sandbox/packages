<?php

namespace ZnSandbox\Sandbox\Bundle\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use ZnDomain\Entity\Interfaces\UniqueInterface;
use ZnDomain\Entity\Interfaces\EntityIdInterface;

class BundleEntity implements ValidationByMetadataInterface, UniqueInterface, EntityIdInterface
{

    private $id = null;

    private $name = null;

    private $className = null;

    private $domain = null;

    private $namespace = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('id', new Assert\NotBlank);
        $metadata->addPropertyConstraint('name', new Assert\NotBlank);
        $metadata->addPropertyConstraint('className', new Assert\NotBlank);
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
        return hash('crc32b', $this->className);
        return $this->id;
    }

    public function setName($value) : void
    {
        $this->name = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setClassName($value) : void
    {
        $this->className = $value;
    }

    public function getClassName()
    {
        return $this->className;
    }

    public function getDomain(): ?DomainEntity
    {
        return $this->domain;
    }

    public function setDomain(?DomainEntity $domain): void
    {
        $this->domain = $domain;
    }

    public function getNamespace()
    {
        return $this->namespace;
    }

    public function setNamespace($namespace): void
    {
        $this->namespace = $namespace;
    }
}
