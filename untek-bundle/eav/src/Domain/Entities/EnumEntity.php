<?php

namespace Untek\Bundle\Eav\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Lib\Components\Status\Enums\StatusEnum;
use Untek\Model\Entity\Interfaces\EntityIdInterface;
use Untek\Model\Validator\Interfaces\ValidationByMetadataInterface;

class EnumEntity implements ValidationByMetadataInterface, EntityIdInterface
{

    private $id = null;

    private $attributeId = null;

    private $name = null;

    private $title = null;

    private $sort = null;

    private $status = StatusEnum::ENABLED;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        //$metadata->addPropertyConstraint('id', new Assert\NotBlank);
        $metadata->addPropertyConstraint('attributeId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('name', new Assert\NotBlank);
        $metadata->addPropertyConstraint('title', new Assert\NotBlank);
        $metadata->addPropertyConstraint('sort', new Assert\NotBlank);
        $metadata->addPropertyConstraint('status', new Assert\NotBlank);
    }

    public function setId($value): void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setattributeId($value): void
    {
        $this->attributeId = $value;
    }

    public function getattributeId()
    {
        return $this->attributeId;
    }

    public function setName($value): void
    {
        $this->name = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setTitle($value): void
    {
        $this->title = $value;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setSort($value): void
    {
        $this->sort = $value;
    }

    public function getSort()
    {
        return $this->sort;
    }

    public function setStatus($value): void
    {
        $this->status = $value;
    }

    public function getStatus()
    {
        return $this->status;
    }


}

