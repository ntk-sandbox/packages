<?php

namespace ZnSandbox\Sandbox\Debug\Domain\Entities;

use ZnDomain\Entity\Interfaces\EntityIdInterface;
use DateTime;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnDomain\Entity\Interfaces\UniqueInterface;

class RequestEntity implements EntityIdInterface, ValidationByMetadataInterface, UniqueInterface
{

    protected $id = null;

    protected $uuid = null;

    protected $appName = null;

    protected $url = null;

    protected $runtime = null;

    protected $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('id', new Assert\Positive());
        $metadata->addPropertyConstraint('uuid', new Assert\NotBlank());
        $metadata->addPropertyConstraint('appName', new Assert\NotBlank());
//        $metadata->addPropertyConstraint('url', new Assert\NotBlank());
        $metadata->addPropertyConstraint('runtime', new Assert\Positive());
        $metadata->addPropertyConstraint('createdAt', new Assert\NotBlank());
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

    public function setUuid($value) : void
    {
        $this->uuid = $value;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function getAppName()
    {
        return $this->appName;
    }

    public function setAppName($appName): void
    {
        $this->appName = $appName;
    }

    public function setUrl($value) : void
    {
        $this->url = $value;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getRuntime()
    {
        return $this->runtime;
    }

    public function setRuntime($runtime): void
    {
        $this->runtime = $runtime;
    }

    public function setCreatedAt($value) : void
    {
        $this->createdAt = $value;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
