<?php

namespace Untek\Bundle\Language\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Lib\Components\Status\Enums\StatusEnum;
use Untek\Model\Components\Constraints\Enum;
use Untek\Model\Validator\Interfaces\ValidationByMetadataInterface;
use Untek\Model\Entity\Interfaces\UniqueInterface;
use Untek\Model\Entity\Interfaces\EntityIdInterface;

class TranslateEntity implements ValidationByMetadataInterface, UniqueInterface, EntityIdInterface
{

    private $id = null;

    private $bundleName = null;

    private $langCode = null;

    private $name = null;

    private $value = null;

    private $statusId = StatusEnum::ENABLED;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('id', new Assert\NotBlank);
        $metadata->addPropertyConstraint('bundleName', new Assert\NotBlank);
        $metadata->addPropertyConstraint('langCode', new Assert\NotBlank);
        $metadata->addPropertyConstraint('name', new Assert\NotBlank);
        $metadata->addPropertyConstraint('value', new Assert\NotBlank);
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

    public function setBundleName($value) : void
    {
        $this->bundleName = $value;
    }

    public function getBundleName()
    {
        return $this->bundleName;
    }

    public function setLangCode($value) : void
    {
        $this->langCode = $value;
    }

    public function getLangCode()
    {
        return $this->langCode;
    }

    public function setName($value) : void
    {
        $this->name = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setValue($value) : void
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
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

