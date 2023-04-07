<?php

namespace Untek\User\Notify\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Lib\Components\Status\Enums\StatusEnum;
use Untek\Model\Components\Constraints\Enum;
use Untek\Model\Validator\Interfaces\ValidationByMetadataInterface;
use Untek\Model\Entity\Interfaces\UniqueInterface;
use Untek\Model\Entity\Interfaces\EntityIdInterface;

class TransportEntity implements ValidationByMetadataInterface, UniqueInterface, EntityIdInterface
{

    private $id = null;

    private $name = null;

    private $handlerClass = null;

    private $statusId = StatusEnum::ENABLED;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('id', new Assert\NotBlank);
        $metadata->addPropertyConstraint('name', new Assert\NotBlank);
        $metadata->addPropertyConstraint('handlerClass', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusEnum::class,
        ]));
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

    public function setName($value) : void
    {
        $this->name = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getHandlerClass()
    {
        return $this->handlerClass;
    }

    public function setHandlerClass($handlerClass): void
    {
        $this->handlerClass = $handlerClass;
    }

    public function setStatusId($value) : void
    {
        $this->statusId = $value;
    }

    public function getStatusId()
    {
        return $this->statusId;
    }


}

