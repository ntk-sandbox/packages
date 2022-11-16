<?php

namespace ZnSandbox\Sandbox\Generator\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use ZnDomain\Entity\Interfaces\UniqueInterface;

class ClassEntity implements ValidationByMetadataInterface, UniqueInterface
{

    private $className = null;

    private $namespace = null;

    private $interfaces = null;

    private $fileName = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('className', new Assert\NotBlank);
        $metadata->addPropertyConstraint('namespace', new Assert\NotBlank);
        $metadata->addPropertyConstraint('interface', new Assert\NotBlank);
        $metadata->addPropertyConstraint('fileName', new Assert\NotBlank);
    }

    public function unique() : array
    {
        return [];
    }

    public function setClassName($value) : void
    {
        $this->className = $value;
    }

    public function getClassName()
    {
        return $this->className;
    }

    public function setNamespace($value) : void
    {
        $this->namespace = $value;
    }

    public function getNamespace()
    {
        return $this->namespace;
    }

    public function setInterfaces($value) : void
    {
        $this->interfaces = $value;
    }

    public function getInterfaces()
    {
        return $this->interfaces;
    }

    public function setFileName($value) : void
    {
        $this->fileName = $value;
    }

    public function getFileName()
    {
        return $this->fileName;
    }


}

