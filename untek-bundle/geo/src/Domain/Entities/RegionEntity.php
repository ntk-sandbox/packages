<?php

namespace Untek\Bundle\Geo\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Lib\Components\I18n\Traits\I18nTrait;
use Untek\Model\Entity\Interfaces\EntityIdInterface;
use Untek\Model\Entity\Interfaces\UniqueInterface;
use Untek\Model\Validator\Interfaces\ValidationByMetadataInterface;

class RegionEntity implements ValidationByMetadataInterface, UniqueInterface, EntityIdInterface
{
//    use LanguageTrait;
    use I18nTrait;

    private $id = null;

    private $countryId = null;

    private $name = null;

    private $nameI18n = null;

    private $localities = null;

    private $country = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
//        $metadata->addPropertyConstraint('id', new Assert\NotBlank);
        $metadata->addPropertyConstraint('countryId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('name', new Assert\NotBlank);
    }

    public function unique(): array
    {
        return [];
    }

    public function setId($value): void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCountryId($value): void
    {
        $this->countryId = $value;
    }

    public function getCountryId()
    {
        return $this->countryId;
    }

    public function setName($value): void
    {
        $this->_setI18n('name', $value);
    }

    public function getName()
    {
        return $this->_getI18n('name');
    }

    public function getNameI18n()
    {
        return $this->_getI18nArray('name');
    }

    public function setNameI18n($nameI18n): void
    {
        $this->_setI18nArray('name', $nameI18n);
    }

    /*public function setName($value) : void
    {
        $this->name = $value;
    }

    public function getName()
    {
        return $this->i18n('name');
    }

    public function getNameI18n()
    {
        return $this->nameI18n;
    }

    public function setNameI18n($nameI18n): void
    {
        $this->nameI18n = $nameI18n;
    }*/

    public function getLocalities()
    {
        return $this->localities;
    }

    public function setLocalities($localities): void
    {
        $this->localities = $localities;
    }

}

