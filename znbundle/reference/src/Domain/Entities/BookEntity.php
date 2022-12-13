<?php

namespace ZnBundle\Reference\Domain\Entities;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnBundle\Language\Domain\Interfaces\Services\RuntimeLanguageServiceInterface;
use ZnLib\Components\Status\Enums\StatusEnum;
use ZnLib\Components\ReadOnly\Helpers\ReadOnlyHelper;
use ZnDomain\Entity\Interfaces\UniqueInterface;
use ZnDomain\Components\Constraints\Enum;
use ZnLib\Components\I18n\Traits\I18nTrait;
use ZnDomain\Components\SoftDelete\Traits\Entity\SoftDeleteEntityTrait;
use ZnDomain\Components\SoftDelete\Traits\Entity\SoftRestoreEntityTrait;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use ZnDomain\Entity\Interfaces\EntityIdInterface;

class BookEntity implements ValidationByMetadataInterface, EntityIdInterface, UniqueInterface
{

//    use StatusReadOnlyEntityTrait;
    use SoftDeleteEntityTrait;
    use SoftRestoreEntityTrait;
    use I18nTrait;

    private $id = null;

    private $parentId = null;

    private $code = null;

    private $title = null;

    private $titleI18n = null;

    private $levels = 1;

    private $entity = null;

    private $props = '{}';

    private $statusId = StatusEnum::ENABLED;

    private $createdAt = null;

    private $updatedAt = null;

    public function __construct(RuntimeLanguageServiceInterface $languageService)
    {
        $this->createdAt = new DateTime();
        $this->_setRuntimeLanguageService($languageService);
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('title', new Assert\NotBlank);
        $metadata->addPropertyConstraint('titleI18n', new Assert\NotBlank);
        $metadata->addPropertyConstraint('levels', new Assert\NotBlank);
        $metadata->addPropertyConstraint('levels', new Assert\Positive());
        $metadata->addPropertyConstraint('entity', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusEnum::class,
        ]));
        $metadata->addPropertyConstraint('createdAt', new Assert\NotBlank);
    }

    public function unique(): array
    {
        return [
            ['code'],
        ];
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function setParentId($parentId): void
    {
        $this->parentId = $parentId;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code): void
    {
        $this->code = $code;
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
        $this->titleI18n = $titleI18n;
    }

    public function setLevels($value)
    {
        $this->levels = $value;
    }

    public function getLevels()
    {
        return $this->levels;
    }

    public function setEntity($value)
    {
        $this->entity = $value;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function setProps($value)
    {
        $this->props = $value;
    }

    public function getProps()
    {
        return $this->props;
    }

    public function setStatusId(int $value): void
    {
        ReadOnlyHelper::checkAttribute($this->statusId, $value, $this, 'statusId');
        $this->statusId = $value;
    }

    public function getStatusId(): int
    {
        return $this->statusId;
    }

    public function setCreatedAt($value)
    {
        $this->createdAt = $value;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setUpdatedAt($value)
    {
        $this->updatedAt = $value;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
