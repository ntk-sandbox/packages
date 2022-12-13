<?php

namespace ZnUser\Notify\Domain\Entities;

use ZnBundle\Person\Domain\Entities\ContactTypeEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnDomain\Validator\Constraints\Boolean;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;

class SettingEntity implements ValidationByMetadataInterface, EntityIdInterface
{

    private $id = null;

    private $userId = null;

    private $notifyTypeId = null;

    private $contactTypeId = null;

    private $isEnabled = false;

    private $notifyType;

    private $contactType;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('userId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('notifyTypeId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('contactTypeId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('isEnabled', new Boolean());
    }

    public function setId($value): void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUserId($value): void
    {
        $this->userId = $value;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setNotifyTypeId(int $value): void
    {
        $this->notifyTypeId = $value;
    }

    public function getNotifyTypeId(): int
    {
        return $this->notifyTypeId;
    }

    public function setContactTypeId(int $value): void
    {
        $this->contactTypeId = $value;
    }

    public function getContactTypeId(): int
    {
        return $this->contactTypeId;
    }

    public function setIsEnabled(bool $value): void
    {
        $this->isEnabled = $value;
    }

    public function getIsEnabled(): bool
    {
        return $this->isEnabled;
    }

    public function getNotifyType(): ?TypeEntity
    {
        return $this->notifyType;
    }

    public function setNotifyType(TypeEntity $notifyType): void
    {
        $this->notifyType = $notifyType;
    }

    public function getContactType(): ?ContactTypeEntity
    {
        return $this->contactType;
    }

    public function setContactType(ContactTypeEntity $contactType): void
    {
        $this->contactType = $contactType;
    }

}
