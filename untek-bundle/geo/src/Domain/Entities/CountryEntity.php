<?php

namespace Untek\Bundle\Geo\Domain\Entities;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Lib\Components\I18n\Traits\I18nTrait;
use Untek\Model\Entity\Interfaces\EntityIdInterface;
use Untek\Model\Entity\Interfaces\UniqueInterface;
use Untek\Model\Validator\Interfaces\ValidationByMetadataInterface;

class CountryEntity implements ValidationByMetadataInterface, UniqueInterface, EntityIdInterface
{

//    use LanguageTrait;
    use I18nTrait;

    private $id = null;

    private $name = null;

    private $nameI18n = null;

    private $regions = null;

    private $localities = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {

    }

    public function unique(): array
    {
        return [];
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
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


    /*public function getName()
    {
        return $this->i18n('name');
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getNameI18n()
    {
        return $this->nameI18n;
    }

    public function setNameI18n($nameI18n): void
    {
        $this->nameI18n = $nameI18n;
    }*/

    public function getRegions()
    {
        return $this->regions;
    }

    public function setRegions($regions): void
    {
        $this->regions = $regions;
    }

    public function getLocalities()
    {
        return $this->localities;
    }

    public function setLocalities($localities): void
    {
        $this->localities = $localities;
    }

}

