<?php

namespace ZnBundle\Person\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnBundle\Language\Domain\Interfaces\Services\RuntimeLanguageServiceInterface;
use ZnLib\Components\I18n\Traits\I18nTrait;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;

class ContactTypeEntity implements ValidationByMetadataInterface, EntityIdInterface
{

//    use LanguageTrait;
    use I18nTrait;

    private $id = null;

    private $name = null;

    private $title = null;

    private $titleI18n = null;

    private $icon = null;

    private $rule = null;

    public function __construct(RuntimeLanguageServiceInterface $runtimeLanguageService)
    {
        $this->_language = $runtimeLanguageService->getLanguage();
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new Assert\NotBlank);
        $metadata->addPropertyConstraint('title', new Assert\NotBlank);
    }

    public function setId($value): void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName(string $value): void
    {
        $this->name = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setTitle($value): void
    {
        $this->_setI18n('title', $value);
    }

    public function getTitle()
    {
        return $this->_getI18n('title');
    }

    public function getTitleI18n()
    {
        return $this->_getI18nArray('title');
    }

    public function setTitleI18n($titleI18n): void
    {
        $this->_setI18nArray('title', $titleI18n);
    }

    /*public function setTitle(string $value): void
    {
        $this->title = $value;
    }

    public function getTitle(): string
    {
        return $this->i18n('title');
    }

    public function getTitleI18n()
    {
        return $this->titleI18n;
    }

    public function setTitleI18n($titleI18n): void
    {
        $this->titleI18n = $titleI18n;
    }*/

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon($icon): void
    {
        $this->icon = $icon;
    }

    public function setRule(string $value): void
    {
        $this->rule = $value;
    }

    public function getRule(): string
    {
        return $this->rule;
    }
}
