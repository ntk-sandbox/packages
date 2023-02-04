<?php

namespace Untek\User\Rbac\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Lib\Components\Status\Enums\StatusEnum;
use Untek\Domain\Components\Constraints\Enum;
use Untek\Domain\Validator\Interfaces\ValidationByMetadataInterface;
use Untek\Domain\Entity\Interfaces\UniqueInterface;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;

class AssignmentEntity implements ValidationByMetadataInterface, UniqueInterface, EntityIdInterface
{

    private $id = null;

    private $identityId = null;

    private $itemName = null;

    private $statusId = StatusEnum::ENABLED;

    private $item = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('identityId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('itemName', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusEnum::class,
        ]));
    }

    public function unique() : array
    {
        return [
            ['identityId', 'itemName'],
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

    public function setIdentityId($value) : void
    {
        $this->identityId = $value;
    }

    public function getIdentityId()
    {
        return $this->identityId;
    }

    public function setItemName($value) : void
    {
        $this->itemName = $value;
    }

    public function getItemName()
    {
        return $this->itemName;
    }

    public function setStatusId(int $value) : void
    {
        $this->statusId = $value;
    }

    public function getStatusId(): int
    {
        return $this->statusId;
    }

    public function getItem(): ?ItemEntity
    {
        return $this->item;
    }

    public function setItem(ItemEntity $item): void
    {
        $this->item = $item;
    }

}
