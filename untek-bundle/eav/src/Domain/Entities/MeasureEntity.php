<?php

namespace Untek\Bundle\Eav\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Model\Entity\Interfaces\EntityIdInterface;
use Untek\Model\Validator\Interfaces\ValidationByMetadataInterface;

class MeasureEntity implements ValidationByMetadataInterface, EntityIdInterface
{

    private $id = null;

    private $parentId = null;

    private $name = null;

    private $title = null;

    private $shortTitle = null;

    private $rate = null;

    private $base = null;

    private $exponent = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        //$metadata->addPropertyConstraint('id', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('parentId', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('name', new Assert\NotBlank);
        $metadata->addPropertyConstraint('title', new Assert\NotBlank);
        $metadata->addPropertyConstraint('shortTitle', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('rate', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('base', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('exponent', new Assert\NotBlank);
    }

    public function setId($value): void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setParentId($value): void
    {
        $this->parentId = $value;
    }

    public function getParentId()
    {
        return $this->parentId;
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

    public function setShortTitle($value): void
    {
        $this->shortTitle = $value;
    }

    public function getShortTitle()
    {
        return $this->shortTitle;
    }

    public function setRate($value): void
    {
        $this->rate = $value;
    }

    public function getRate()
    {
        return $this->rate;
    }

    public function getBase()
    {
        return $this->base;
    }

    public function setBase($base): void
    {
        $this->base = $base;
    }

    public function getExponent()
    {
        return $this->exponent;
    }

    public function setExponent($exponent): void
    {
        $this->exponent = $exponent;
    }

}

