<?php

namespace ZnSandbox\Sandbox\I18n\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use ZnDomain\Entity\Interfaces\UniqueInterface;
use ZnDomain\Entity\Interfaces\EntityIdInterface;

class TranslateEntity implements ValidationByMetadataInterface, UniqueInterface, EntityIdInterface
{

    private $id = null;

    private $entityTypeId = null;

    private $entityId = null;

    private $languageId = null;

    private $value = null;

    private $language = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('entityTypeId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('entityTypeId', new Assert\Positive());
        $metadata->addPropertyConstraint('entityId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('entityId', new Assert\Positive());
        $metadata->addPropertyConstraint('languageId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('languageId', new Assert\Positive());
        $metadata->addPropertyConstraint('value', new Assert\NotBlank);
    }

    public function unique() : array
    {
        return [
            ['entityTypeId', 'entityId', 'languageId']
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

    public function setEntityTypeId($value) : void
    {
        $this->entityTypeId = $value;
    }

    public function getEntityTypeId()
    {
        return $this->entityTypeId;
    }

    public function setEntityId($value) : void
    {
        $this->entityId = $value;
    }

    public function getEntityId()
    {
        return $this->entityId;
    }

    public function setLanguageId($value) : void
    {
        $this->languageId = $value;
    }

    public function getLanguageId()
    {
        return $this->languageId;
    }

    public function setValue($value) : void
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setLanguage($language): void
    {
        $this->language = $language;
    }

    public function getLanguage()
    {
        return $this->language;
    }
}

