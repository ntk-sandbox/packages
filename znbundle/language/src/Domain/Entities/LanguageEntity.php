<?php

namespace ZnBundle\Language\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;

class LanguageEntity implements ValidationByMetadataInterface, EntityIdInterface
{

    private $id = null;
    private $code = null;
    private $title = null;
    private $name = null;
    private $locale = null;
    private $isMain = null;
    private $isEnabled = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('code', new Assert\NotBlank);
        $metadata->addPropertyConstraint('title', new Assert\NotBlank);
        $metadata->addPropertyConstraint('name', new Assert\NotBlank);
        $metadata->addPropertyConstraint('locale', new Assert\NotBlank);
        $metadata->addPropertyConstraint('isMain', new Assert\NotBlank);
        $metadata->addPropertyConstraint('isEnabled', new Assert\NotBlank);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code): void
    {
        $this->code = $code;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function setLocale($locale): void
    {
        $this->locale = $locale;
    }

    public function getIsMain()
    {
        return $this->isMain;
    }

    public function setIsMain($isMain): void
    {
        $this->isMain = $isMain;
    }

    public function getIsEnabled()
    {
        return $this->isEnabled;
    }

    public function setIsEnabled($isEnabled): void
    {
        $this->isEnabled = $isEnabled;
    }

}
