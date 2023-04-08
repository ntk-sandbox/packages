<?php

namespace Untek\User\Notify\Domain\Entities;

use DateTime;
use Untek\Core\Collection\Helpers\CollectionHelper;
use Untek\Model\Components\Constraints\Enum;
use Untek\User\Notify\Domain\Enums\NotifyStatusEnum;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Lib\Components\Status\Enums\StatusEnum;
use Untek\Core\Enum\Helpers\EnumHelper;
use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Component\I18Next\Helpers\TranslatorHelper;
use Untek\Model\Entity\Helpers\EntityHelper;
use Untek\Model\Entity\Interfaces\EntityIdInterface;
use Untek\Model\Validator\Interfaces\ValidationByMetadataInterface;

class NotifyEntity implements ValidationByMetadataInterface, EntityIdInterface
{

    protected $id = null;

    protected $recipientId = null;

    protected $typeId = null;

    protected $color = 'info';

    protected $icon = 'fas fa-info';

    protected $subject = null;

    protected $content = null;

    protected $attributes = [];

    protected $statusId = StatusEnum::ENABLED;

    protected $createdAt = null;

    protected $type = null;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('recipientId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('typeId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => NotifyStatusEnum::class,
        ]));
        $metadata->addPropertyConstraint('createdAt', new Assert\NotBlank);
    }

    public function setId($value): void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTypeId(): string
    {
        return $this->typeId;
    }

    public function setTypeId(string $typeId): void
    {
        $this->typeId = $typeId;
    }

    public function getColor()
    {
        if ($this->color) {
            return $this->color;
        }
        if ($this->getType()) {
            return $this->getType()->getColor();
        }
    }

    public function setColor($color): void
    {
        $this->color = $color;
    }

    public function getIcon(): string
    {
        if ($this->icon) {
            return $this->icon;
        }
        if ($this->getType()) {
            return $this->getType()->getIcon();
        }
    }

    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }

    public function setRecipientId($value): void
    {
        $this->recipientId = $value;
    }

    public function getRecipientId()
    {
        return $this->recipientId;
    }

    public function setSubject($value): void
    {
        $this->subject = $value;
    }

    public function getSubject()
    {
        if ($this->subject) {
            return $this->subject;
        }
        if ($this->getType()) {
            /** @var TypeI18nEntity[] $i18nCollection */
            $i18nCollection = CollectionHelper::indexing($this->getType()->getI18n(), 'languageCode');
            $i18nEntity = $i18nCollection['ru'];
            return TranslatorHelper::processVariables($i18nEntity->getSubject(), $this->getAttributes());
        }
    }

    public function setContent($value): void
    {
        $this->content = $value;
    }

    public function getContent()
    {
        if ($this->content) {
            return $this->content;
        }
        if ($this->getType()) {
            /** @var TypeI18nEntity[] $i18nCollection */
            $i18nCollection = CollectionHelper::indexing($this->getType()->getI18n(), 'languageCode');
            $i18nEntity = $i18nCollection['ru'];
            return TranslatorHelper::processVariables($i18nEntity->getContent(), $this->getAttributes());
        }
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    public function addAttribute(string $key, string $value): void
    {
        ArrayHelper::setValue($this->attributes, $key, $value);
    }

    public function setStatusId($value): void
    {
        $this->statusId = $value;
    }

    public function getStatusId()
    {
        return $this->statusId;
    }

    public function seen(): void
    {
        $this->statusId = NotifyStatusEnum::SEEN;
    }

    public function setCreatedAt($value): void
    {
        $this->createdAt = $value;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getType(): ?TypeEntity
    {
        return $this->type;
    }

    public function setType(TypeEntity $type): void
    {
        $this->type = $type;
    }
}
