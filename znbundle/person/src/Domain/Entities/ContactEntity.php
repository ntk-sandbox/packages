<?php

namespace ZnBundle\Person\Domain\Entities;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;

class ContactEntity implements ValidationByMetadataInterface, EntityIdInterface
{

    private $id = null;

    private $identityId = null;

    private $typeId = null;

    private $isMain = null;

    private $value = null;

    private $type = null;

    private $createdAt = null;

    private $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new DateTime;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('identityId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('typeId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('isMain', new Assert\NotBlank);
        $metadata->addPropertyConstraint('value', new Assert\NotBlank);
    }

    public function setId($value): void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIdentityId(int $value): void
    {
        $this->identityId = $value;
    }

    public function getIdentityId(): int
    {
        return $this->identityId;
    }

    public function setTypeId(int $value): void
    {
        $this->typeId = $value;
    }

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function setIsMain(bool $value): void
    {
        $this->isMain = $value;
    }

    public function getIsMain(): bool
    {
        return $this->isMain;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getType(): ? ContactTypeEntity
    {
        return $this->type;
    }

    public function setType(ContactTypeEntity $type): void
    {
        $this->type = $type;
    }
}
