<?php

namespace ZnUser\Notify\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;

class TypeI18nEntity implements ValidationByMetadataInterface, EntityIdInterface
{

    private $id = null;

    private $typeId = null;

    private $languageCode = null;

    private $subject = null;

    private $content = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('typeId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('languageCode', new Assert\NotBlank);
        $metadata->addPropertyConstraint('subject', new Assert\NotBlank);
        $metadata->addPropertyConstraint('content', new Assert\NotBlank);
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

    public function setLanguageCode($value): void
    {
        $this->languageCode = $value;
    }

    public function getLanguageCode()
    {
        return $this->languageCode;
    }

    public function setSubject($value): void
    {
        $this->subject = $value;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setContent($value): void
    {
        $this->content = $value;
    }

    public function getContent()
    {
        return $this->content;
    }


}

