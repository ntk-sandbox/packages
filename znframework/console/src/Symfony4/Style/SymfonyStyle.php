<?php

namespace ZnFramework\Console\Symfony4\Style;

use ZnCore\Code\Helpers\PropertyHelper;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnCore\Text\Helpers\Inflector;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnDomain\Validator\Entities\ValidationErrorEntity;
use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnDomain\Validator\Helpers\ValidationHelper;
use ZnFramework\Console\Symfony4\Question\ChoiceQuestion;

class SymfonyStyle extends \Symfony\Component\Console\Style\SymfonyStyle
{


    /**
     * @param object $reportForm
     * @return array | Enumerable | ValidationErrorEntity[] | null
     */
    protected function validateForm(object $reportForm): ?Enumerable
    {
        try {
            ValidationHelper::validateEntity($reportForm);
        } catch (UnprocessibleEntityException $e) {
            $message = '';
            foreach ($e->getErrorCollection() as $errorEntity) {
                $message .= $errorEntity->getField() . ' - ' . $errorEntity->getMessage() . PHP_EOL;
            }
            $message = trim($message);
            $this->warning($message);
            return $e->getErrorCollection();
        }
        return null;
    }


    public function inputFormValues(object $reportForm)
    {
        $attributes = null;
        do {
            $this->inputFormAttributes($reportForm, $attributes);
            $errorCollection = $this->validateForm($reportForm);
            if ($errorCollection && $errorCollection->count()) {
                $attrs = [];
                foreach ($errorCollection as $errorEntity) {
                    $attrs[] = $errorEntity->getField();
                }
                $attributes = $attrs;
            }
        } while ($errorCollection && $errorCollection->count());
    }

    public function inputFormAttributes(object $reportForm, array $attributes = null)
    {
        if ($attributes == null) {
            $attributes = EntityHelper::getAttributeNames($reportForm);
        }
        foreach ($attributes as $attributeName) {
            $value = PropertyHelper::getValue($reportForm, $attributeName);
//            if ($value == null) {
            $attributeTitle = Inflector::titleize($attributeName);
//                $value = $this->inputString("Input \"$attributeTitle\"");
            $value = $this->ask($attributeTitle,$value);
            PropertyHelper::setValue($reportForm, $attributeName, $value);
//            }
        }
    }

    public function choiceMulti(string $question, array $choices, $default = null)
    {
        if (null !== $default) {
            $values = array_flip($choices);
            $default = $values[$default] ?? $default;
        }

        $choiceQuestion = new ChoiceQuestion($question, $choices, $default);
        $choiceQuestion->setMultiselect(true);
        return $this->askQuestion($choiceQuestion);
    }

    public function choice(string $question, array $choices, $default = null)
    {
        if (null !== $default) {
            $values = array_flip($choices);
            $default = $values[$default] ?? $default;
        }

        $choiceQuestion = new ChoiceQuestion($question, $choices, $default);
        return $this->askQuestion($choiceQuestion);
    }
}
