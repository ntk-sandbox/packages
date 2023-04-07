<?php

namespace Untek\Bundle\Eav\Domain\Libs;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;
use Untek\Bundle\Eav\Domain\Entities\AttributeEntity;
use Untek\Model\Validator\Constraints\Boolean;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\Collection\Helpers\CollectionHelper;

class Rules
{

    private $rules = [];

    public function convert(Enumerable $attributesCollection): array
    {
        $this->rules = [];
        /** @var AttributeEntity $attributeEntity */
        foreach ($attributesCollection as $attributeEntity) {
            $attributeName = $attributeEntity->getName();
            $this->handleRules($attributeEntity, $attributeName);
            $this->castChoices($attributeEntity, $attributeName);
            $this->castBoolean($attributeEntity, $attributeName);
            $this->castRequired($attributeEntity, $attributeName);
        }
        return $this->rules;
    }

    private function addRule(string $attributeName, Constraint $constraint)
    {
        $this->rules[$attributeName][] = $constraint;
    }

    private function handleRules(AttributeEntity $attributeEntity, string $attributeName)
    {
        foreach ($attributeEntity->getRules() as $ruleEntity) {
            $ruleName = $ruleEntity->getName();
            $isClassName = strpos($ruleName, '\\') !== false;
            $ruleClassName = $isClassName ? $ruleName : 'Symfony\Component\Validator\Constraints\\' . ucfirst($ruleName);
            if ($ruleClassName) {
                $params = $ruleEntity->getParams();
                if ($params) {
                    $params = json_decode($params);
                    $constraintInstance = new $ruleClassName($params);
                } else {
                    $constraintInstance = new $ruleClassName();
                }
                $this->addRule($attributeName, $constraintInstance);
            }
        }
    }

    private function castChoices(AttributeEntity $attributeEntity, string $attributeName)
    {
        $enumCollection = $attributeEntity->getEnums();
        if ($enumCollection && $enumCollection->count() > 0) {
            $choiceConstraint = new Assert\Choice([
                'choices' => CollectionHelper::getColumn($enumCollection, 'name'),
            ]);
            $this->addRule($attributeName, $choiceConstraint);
        }
    }

    private function castBoolean(AttributeEntity $attributeEntity, string $attributeName)
    {
        $isBoolean = $attributeEntity->getType() == 'boolean' || $attributeEntity->getType() == 'bool';
        if ($isBoolean) {
            $choiceConstraint = new Boolean();
            $this->addRule($attributeName, $choiceConstraint);
        }
    }

    private function castRequired(AttributeEntity $attributeEntity, string $attributeName)
    {
        if ($attributeEntity->getIsRequired()) {
            $this->addRule($attributeName, new Assert\NotBlank);
        } elseif (!$attributeEntity->getIsRequired()) {
            $this->addRule($attributeName, new Assert\Length(['min' => 0]));
        }
    }
}
