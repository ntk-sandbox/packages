<?php

namespace Untek\Bundle\Summary\Domain\Entities;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;
use Untek\Domain\Validator\Interfaces\ValidationByMetadataInterface;

class CounterEntity implements ValidationByMetadataInterface, EntityIdInterface
{

    private $id = null;

    private $entityName = null;

    private $entityId = null;

    private $type = null;

    private $userId = null;

    private $sessionId = null;

    private $rate = null;

    private $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('entityName', new Assert\NotBlank);
        $metadata->addPropertyConstraint('entityId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('type', new Assert\NotBlank);
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

    public function setType($value): void
    {
        $this->type = $value;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setUserId($value): void
    {
        $this->userId = $value;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setSessionId($value): void
    {
        $this->sessionId = $value;
    }

    public function getSessionId()
    {
        return $this->sessionId;
    }

    public function setRate($value): void
    {
        $this->rate = $value;
    }

    public function getRate()
    {
        return $this->rate;
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

