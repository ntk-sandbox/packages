<?php

namespace ZnBundle\Reference\Domain\Entities;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnBundle\Language\Domain\Interfaces\Services\RuntimeLanguageServiceInterface;
use ZnDomain\Components\Constraints\Enum;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnDomain\Entity\Interfaces\UniqueInterface;
use ZnLib\Components\I18n\Traits\I18nTrait;
use ZnLib\Components\ReadOnly\Helpers\ReadOnlyHelper;
use ZnDomain\Components\SoftDelete\Traits\Entity\SoftDeleteEntityTrait;
use ZnDomain\Components\SoftDelete\Traits\Entity\SoftRestoreEntityTrait;
use ZnLib\Components\Status\Enums\StatusEnum;

class ItemEntity implements ValidationByMetadataInterface, EntityIdInterface, UniqueInterface
{

//    use StatusReadOnlyEntityTrait;
    use SoftDeleteEntityTrait;
    use SoftRestoreEntityTrait;
    use I18nTrait;

    private $id = null;
    private $bookId = null;
    private $parentId = null;
    private $code = null;
    private $title = null;
    private $titleI18n = null;
    private $shortTitle = null;
    private $entity = null;
    private $statusId = StatusEnum::ENABLED;
    private $sort = 0;
    private $props = null;
    private $createdAt = null;
    private $updatedAt = null;
    private $book;
    private $parent;
    private $children;

    /* @var \ZnCore\Collection\Interfaces\Enumerable | ItemTranslationEntity[] */
//    private $translations = null;

    public function __construct(RuntimeLanguageServiceInterface $languageService)
    {
        $this->createdAt = new DateTime();
        $this->_setRuntimeLanguageService($languageService);
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('id', new Assert\Positive);
        $metadata->addPropertyConstraint('bookId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('bookId', new Assert\Positive);
        $metadata->addPropertyConstraint('parentId', new Assert\Positive);
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusEnum::class,
        ]));
        $metadata->addPropertyConstraint('sort', new Assert\PositiveOrZero());
        $metadata->addPropertyConstraint('title', new Assert\Length(['min' => 1]));
        $metadata->addPropertyConstraint('titleI18n', new Assert\NotBlank);
    }

    public function unique(): array
    {
        return [
            ['bookId', 'code'],
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

    public function setBookId($value)
    {
        $this->bookId = $value;
    }

    public function getBookId()
    {
        return $this->bookId;
    }

    public function setParentId($value)
    {
        $this->parentId = $value;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function setCode($value)
    {
        $this->code = $value;
    }

    public function getCode()
    {
        return $this->code;
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

    public function getShortTitle()
    {
        if (empty($this->shortTitle) && !empty($this->translations) && $this->translations->count()) {
            /** @var ItemTranslationEntity $translationEntity */
            $translationEntity = $this->translations->first();
            $this->shortTitle = $translationEntity->getShortTitle();
        }
        return $this->shortTitle;
    }

    public function setShortTitle($shortTitle): void
    {
        $this->shortTitle = $shortTitle;
    }

    public function setEntity($value)
    {
        $this->entity = $value;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function getSort()
    {
        return $this->sort;
    }

    public function setSort($sort): void
    {
        $this->sort = $sort;
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

    /*public function getTranslations(): ?Enumerable
    {
        return $this->translations;
    }

    public function setTranslations(Enumerable $translations = null): void
    {
        $this->translations = $translations;
    }*/

    public function getBook(): ?BookEntity
    {
        return $this->book;
    }

    public function setBook(BookEntity $book): void
    {
        $this->book = $book;
    }

    public function getParent(): ?ItemEntity
    {
        return $this->parent;
    }

    public function setParent(ItemEntity $parent): void
    {
        $this->parent = $parent;
    }

    public function getChildren(): ?Enumerable
    {
        return $this->children;
    }

    public function setChildren(?Enumerable $children): void
    {
        $this->children = $children;
    }
}
