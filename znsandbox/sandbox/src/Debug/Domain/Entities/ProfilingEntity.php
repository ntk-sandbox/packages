<?php

namespace ZnSandbox\Sandbox\Debug\Domain\Entities;

use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnDomain\Entity\Interfaces\UniqueInterface;

class ProfilingEntity implements EntityIdInterface, ValidationByMetadataInterface, UniqueInterface
{

    protected $id = null;

    protected $requestId = null;

    protected $name = null;

    protected $timestamp = null;

    protected $runtime = null;

    protected $request = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('id', new Assert\Positive());
        $metadata->addPropertyConstraint('requestId', new Assert\NotBlank());
        $metadata->addPropertyConstraint('requestId', new Assert\Positive());
        $metadata->addPropertyConstraint('name', new Assert\NotBlank());
        $metadata->addPropertyConstraint('timestamp', new Assert\NotBlank());
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

    public function setRequestId($value) : void
    {
        $this->requestId = $value;
    }

    public function getRequestId()
    {
        return $this->requestId;
    }

    public function setName($value) : void
    {
        $this->name = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setTimestamp($value) : void
    {
        $this->timestamp = $value;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function getRuntime()
    {
        return $this->runtime;
    }

    public function setRuntime($runtime): void
    {
        $this->runtime = $runtime;
    }

    public function getRequest(): ?RequestEntity
    {
        return $this->request;
    }

    public function setRequest(?RequestEntity $request): void
    {
        $this->request = $request;
    }
}
