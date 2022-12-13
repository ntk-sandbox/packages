<?php

namespace ZnBundle\Eav\Domain\Forms;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use ZnBundle\Eav\Domain\Entities\AttributeEntity;
use ZnBundle\Eav\Domain\Entities\EntityEntity;
use ZnBundle\Eav\Domain\Entities\EnumEntity;
use ZnBundle\Eav\Domain\Libs\Rules;
use ZnBundle\Eav\Domain\Traits\DynamicAttribute;
use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\Contract\Arr\Interfaces\ToArrayInterface;
use ZnCore\Contract\Common\Exceptions\InvalidArgumentException;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnLib\Components\DynamicEntity\Interfaces\ValidateDynamicEntityInterface;
use ZnLib\I18Next\Facades\I18Next;
use ZnLib\Web\Form\Interfaces\BuildFormInterface;

class DynamicForm implements BuildFormInterface, ToArrayInterface, ValidateDynamicEntityInterface
{

    use DynamicAttribute;

    protected $_entityEntity;
    protected $_validationRules = [];

    public function __construct(EntityEntity $entityEntity)
    {
        if ($entityEntity) {
            $this->_entityEntity = $entityEntity;
            $this->_attributes = $entityEntity->getAttributeNames();
            //$this->_validationRules = $entityEntity->getRules();
            $rulesLib = new Rules();
            $this->_validationRules = $rulesLib->convert($entityEntity->getAttributes());
        }
        if (empty($this->_attributes)) {
            throw new InvalidArgumentException('No attributes for dynamic entity!');
        }
        foreach ($this->attributes() as $attributeName) {
            $this->{$attributeName} = null;
        }
    }

    public function validationRules(): array
    {
        return $this->_validationRules;
    }

    public function buildForm(FormBuilderInterface $formBuilder)
    {
        /** @var AttributeEntity[] | Enumerable $attributesCollection */
        $attributesCollection = $this->_entityEntity->getAttributes();
        foreach ($attributesCollection as $attributeEntity) {
            $typeInfo = $this->convertType($attributeEntity);
            $attributeOptions = [
                'label' => $attributeEntity->getTitle()
            ];
            $attributeOptions = ArrayHelper::merge($attributeOptions, $typeInfo['options'] ?? []);
            $formBuilder->add($attributeEntity->getName(), $typeInfo['class'], $attributeOptions);
        }
        $formBuilder->add('save', SubmitType::class, [
            'label' => I18Next::t('core', 'action.save')
        ]);
    }

    private function convertType(AttributeEntity $attributeEntity)
    {
        $type = $attributeEntity->getType();
        $default = [
            'class' => TextType::class,
            'options' => [],
        ];
        $assoc = [
            'string' => [
                'class' => TextType::class,
                'options' => [],
            ],
            'text' => [
                'class' => TextareaType::class,
                'options' => [],
            ],
            'integer' => [
                'class' => NumberType::class,
                'options' => [],
            ],
            'enum' => [
                'class' => ChoiceType::class,
                'options' => [
                    'choices' => $this->enumsToChoices($attributeEntity->getEnums()),
                ],
            ],
        ];
        return $assoc[$type] ?? $default;
    }

    private function enumsToChoices(?Enumerable $enumCollection): array
    {
        if (empty($enumCollection)) {
            return [];
        }
        $options = [];
        /** @var EnumEntity[] $enumCollection */
        foreach ($enumCollection as $enumEntity) {
            $options[$enumEntity->getTitle()] = $enumEntity->getName();
        }
        return $options;
    }
}