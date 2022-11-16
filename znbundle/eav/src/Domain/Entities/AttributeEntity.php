<?php

namespace ZnBundle\Eav\Domain\Entities;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnBundle\Eav\Domain\Enums\AttributeTypeEnum;
use ZnDomain\Components\Constraints\Enum;
use ZnCore\Enum\Helpers\EnumHelper;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnLib\Components\Status\Enums\StatusEnum;
use ZnLib\Web\Form\Interfaces\BuildFormInterface;

class AttributeEntity implements ValidationByMetadataInterface, EntityIdInterface, BuildFormInterface
{

    private $id = null;

    private $name = null;

    private $type = null;

    private $default = null;

    private $isRequired = null;

    private $title = null;

    private $description = null;

    private $unitId = null;

    private $status = StatusEnum::ENABLED;

    private $rules;

    private $enums;

    private $unit;

    private $tie;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        //$metadata->addPropertyConstraint('id', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('name', new Assert\NotBlank);
        $metadata->addPropertyConstraint('type', new Assert\NotBlank);
        $metadata->addPropertyConstraint('type', new Enum([
            'class' => AttributeTypeEnum::class,
        ]));
        //$metadata->addPropertyConstraint('default', new Assert\NotBlank);
        $metadata->addPropertyConstraint('title', new Assert\NotBlank);
        //$metadata->addPropertyConstraint('description', new Assert\NotBlank);
        //$metadata->addPropertyConstraint('unitId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('unitId', new Assert\Positive());
//        $metadata->addPropertyConstraint('status', new Assert\NotBlank);
    }

    public function buildForm(FormBuilderInterface $formBuilder)
    {
        $formBuilder
            ->add('name', TextType::class, [
                'label' => 'name'
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'type',
                'choices' => array_flip(EnumHelper::getOptions(AttributeTypeEnum::class)),
            ])
            ->add('default', TextType::class, [
                'label' => 'default'
            ])
            ->add('title', TextType::class, [
                'label' => 'title'
            ])
            ->add('description', TextType::class, [
                'label' => 'description'
            ])
            ->add('unitId', TextType::class, [
                'label' => 'unitId'
            ])/*->add('status', TextType::class, [
                'label' => 'status'
            ])*/
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

    public function setName($value): void
    {
        $this->name = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setType($value): void
    {
        $this->type = $value;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setDefault($value): void
    {
        $this->default = $value;
    }

    public function getDefault()
    {
        return $this->default;
    }

    public function getIsRequired()
    {
        return $this->isRequired;
    }

    public function setIsRequired($isRequired): void
    {
        $this->isRequired = $isRequired;
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

    public function setUnitId($value): void
    {
        $this->unitId = $value;
    }

    public function getUnitId()
    {
        return $this->unitId;
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
     * @return ValidationEntity[]|null|Enumerable
     */
    public function getRules(): ?Enumerable
    {
        return $this->rules;
    }

    public function setRules(Enumerable $rules): void
    {
        $this->rules = $rules;
    }

    /**
     * @return EnumEntity[]|null|Enumerable
     */
    public function getEnums(): ?Enumerable
    {
        return $this->enums;
    }

    public function setEnums(Enumerable $enums): void
    {
        $this->enums = $enums;
    }

    public function getUnit(): ?MeasureEntity
    {
        return $this->unit;
    }

    public function setUnit(?MeasureEntity $unit): void
    {
        $this->unit = $unit;
    }

    public function getTie(): ?EntityAttributeEntity
    {
        return $this->tie;
    }

    public function setTie(EntityAttributeEntity $tie): void
    {
        $this->tie = $tie;
    }

}
