<?php

namespace ZnBundle\Eav\Domain\Entities;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnBundle\Eav\Domain\Enums\AttributeTypeEnum;
use ZnLib\Components\Status\Enums\StatusEnum;
use ZnCore\Enum\Helpers\EnumHelper;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use ZnLib\Web\Form\Interfaces\BuildFormInterface;

class EntityAttributeEntity implements ValidationByMetadataInterface, EntityIdInterface, BuildFormInterface
{

    private $id = null;

    private $entityId = null;

    private $attributeId = null;

    private $default = null;

    private $isRequired = null;

    private $name = null;

    private $title = null;

    private $description = null;

    private $sort = 10;

    private $status = StatusEnum::ENABLED;

    private $isList = false;

    private $attribute;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        //$metadata->addPropertyConstraint('id', new Assert\NotBlank);
        $metadata->addPropertyConstraint('entityId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('attributeId', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('name', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('title', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('description', new Assert\NotBlank);
        $metadata->addPropertyConstraint('sort', new Assert\NotBlank);
        $metadata->addPropertyConstraint('status', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('isList', new Assert\NotBlank);
    }

    public function buildForm(FormBuilderInterface $formBuilder)
    {
        // id	entity_id	attribute_id						sort	status	is_list
        $formBuilder
            ->add('name', TextType::class, [
                'label' => 'name'
            ])
            ->add('title', TextType::class, [
                'label' => 'title'
            ])
            ->add('is_required', CheckboxType::class, [
                'label' => 'is_required'
            ])
            ->add('default', TextType::class, [
                'label' => 'default'
            ])
            ->add('description', TextType::class, [
                'label' => 'description'
            ])
        ;
    }

    public function setId($value): void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setEntityId($value): void
    {
        $this->entityId = $value;
    }

    public function getEntityId()
    {
        return $this->entityId;
    }

    public function setattributeId($value): void
    {
        $this->attributeId = $value;
    }

    public function getattributeId()
    {
        return $this->attributeId;
    }

    public function getDefault()
    {
        return $this->default;
    }

    public function setDefault($default): void
    {
        $this->default = $default;
    }

    public function getIsRequired()
    {
        return $this->isRequired;
    }

    public function setIsRequired($isRequired): void
    {
        $this->isRequired = $isRequired;
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

    public function setDescription($value): void
    {
        $this->description = $value;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setSort($value): void
    {
        $this->sort = $value;
    }

    public function getSort()
    {
        return $this->sort;
    }

    public function setStatus($value): void
    {
        $this->status = $value;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function isList(): bool
    {
        return $this->isList;
    }

    public function setIsList(bool $isList): void
    {
        $this->isList = $isList;
    }

    public function getAttribute(): ?AttributeEntity
    {
        return $this->attribute;
    }

    public function setAttribute(?AttributeEntity $attribute): void
    {
        $this->attribute = $attribute;
    }

}
