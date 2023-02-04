<?php

namespace Untek\User\Notify\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Domain\Validator\Interfaces\ValidationByMetadataInterface;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;

class TypeEntity implements ValidationByMetadataInterface, EntityIdInterface
{

    private $id = null;

    private $name = null;

    private $color = null;

    private $icon = null;

    private $i18n = null;

    private $transports = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new Assert\NotBlank);
        $metadata->addPropertyConstraint('color', new Assert\NotBlank);
        $metadata->addPropertyConstraint('icon', new Assert\NotBlank);
    }

    public function setId($value): void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($value): void
    {
        $this->name = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setColor($value): void
    {
        $this->color = $value;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setIcon($value): void
    {
        $this->icon = $value;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @return Enumerable|null|TypeI18nEntity[]
     */
    public function getI18n(): ?Enumerable
    {
        return $this->i18n;
    }

    public function setI18n(Enumerable $i18n): void
    {
        $this->i18n = $i18n;
    }

    /**
     * @return Enumerable|null|TransportEntity
     */
    public function getTransports(): ?Enumerable
    {
        return $this->transports;
    }

    public function setTransports(Enumerable $transports): void
    {
        $this->transports = $transports;
    }
}
