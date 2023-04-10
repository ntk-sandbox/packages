<?php

namespace Untek\Bundle\Eav\Domain\Entities;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Bundle\Eav\Domain\Libs\Rules;
use Untek\Model\Validator\Interfaces\ValidationByMetadataInterface;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\Collection\Helpers\CollectionHelper;
use Untek\Model\Entity\Interfaces\EntityIdInterface;
use Untek\Lib\Components\Status\Enums\StatusEnum;
use Untek\Component\Web\Form\Interfaces\BuildFormInterface;

class EntityEntity implements ValidationByMetadataInterface, EntityIdInterface, BuildFormInterface
{

    private $id = null;

    private $categoryId = null;

    private $name = null;

    private $title = null;

    private $handler = null;

    private $status = StatusEnum::ENABLED;

    private $attributes = null;

    private $attributesTie = null;

    private $category = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('categoryId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('name', new Assert\NotBlank);
        $metadata->addPropertyConstraint('title', new Assert\NotBlank);
        $metadata->addPropertyConstraint('handler', new Assert\NotBlank);
        $metadata->addPropertyConstraint('status', new Assert\NotBlank);
    }

    public function buildForm(FormBuilderInterface $formBuilder)
    {
        $formBuilder
            ->add('categoryId', TextType::class, [
                'label' => 'categoryId'
            ])
            ->add('name', TextType::class, [
                'label' => 'name'
            ])
            ->add('title', TextType::class, [
                'label' => 'title'
            ])
            ->add('handler', TextType::class, [
                'label' => 'handler'
            ])/*->add('status', TextType::class, [
                'label' => 'status'
            ])*/
        ;
    }

    public function getAttributeNames()
    {
        $attributes = $this->getAttributes();
        if ($attributes) {
            return CollectionHelper::getColumn($attributes, 'name');
        }
        return null;
    }

    /**
     * @return array|null|Constraint[]
     */
    public function getRules()
    {
        $attributesCollection = $this->getAttributes();
        if (empty($attributesCollection)) {
            return null;
        }
        $rulesLib = new Rules();
        return $rulesLib->convert($attributesCollection);
    }

    public function setId($value): void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCategoryId($value): void
    {
        $this->categoryId = $value;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
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

    public function setHandler($value): void
    {
        $this->handler = $value;
    }

    public function getHandler()
    {
        return $this->handler;
    }

    public function setStatus($value): void
    {
        $this->status = $value;
    }

    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return Enumerable|null|AttributeEntity[]
     */
    public function getAttributes(): ?Enumerable
    {
        return $this->attributes;
    }

    public function setAttributes(?Enumerable $attributes): void
    {
        $this->attributes = $attributes;
    }

    public function getAttributesTie(): ?Enumerable
    {
        return $this->attributesTie;
    }

    public function setAttributesTie(Enumerable $attributesTie): void
    {
        $this->attributesTie = $attributesTie;
    }

    public function getCategory(): ?CategoryEntity
    {
        return $this->category;
    }

    public function setCategory(CategoryEntity $category): void
    {
        $this->category = $category;
    }
}
