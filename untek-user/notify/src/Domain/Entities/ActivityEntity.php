<?php

namespace Untek\User\Notify\Domain\Entities;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Model\Entity\Interfaces\EntityIdInterface;
use Untek\Model\Validator\Interfaces\ValidationByMetadataInterface;

class ActivityEntity implements ValidationByMetadataInterface, EntityIdInterface
{

    private $id = null;

    private $typeId = null;

    private $entityName = null;

    private $entityId = null;

    private $userId = null;

    private $action = null;

    private $attributes = null;

    private $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('typeId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('entityName', new Assert\NotBlank);
        $metadata->addPropertyConstraint('entityId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('userId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('action', new Assert\NotBlank);
        $metadata->addPropertyConstraint('createdAt', new Assert\NotBlank);
    }

    public function setId($value): void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTypeId($value): void
    {
        $this->typeId = $value;
    }

    public function getTypeId()
    {
        return $this->typeId;
    }

    public function setEntityName($value): void
    {
        $this->entityName = $value;
    }

    public function getEntityName()
    {
        return $this->entityName;
    }

    public function setEntityId($value): void
    {
        $this->entityId = $value;
    }

    public function getEntityId()
    {
        return $this->entityId;
    }

    public function setUserId($value): void
    {
        $this->userId = $value;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setAction($value): void
    {
        $this->action = $value;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setAttributes($value): void
    {
        $this->attributes = $value;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setCreatedAt($value): void
    {
        $this->createdAt = $value;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }


}

