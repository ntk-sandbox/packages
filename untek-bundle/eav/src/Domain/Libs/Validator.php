<?php

namespace Untek\Bundle\Eav\Domain\Libs;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Untek\Domain\Validator\Entities\ValidationErrorEntity;
use Untek\Domain\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Domain\Validator\Helpers\SymfonyValidationHelper;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\Collection\Libs\Collection;

class Validator
{

    public function validate(array $data, array $rules)
    {
        $violations = $this->validateData($data, $rules);
        $errorCollection = $this->createErrorCollectionFromViolationList($violations);
        if ($errorCollection->count()) {
            $exception = new UnprocessibleEntityException;
            $exception->setErrorCollection($errorCollection);
            throw $exception;
        }
    }

    public function validateData(array $data, array $rules): ConstraintViolationList
    {
        //$rules = $entity->validationRules();
        $validator = SymfonyValidationHelper::createValidator();
        $constraints = new Assert\Collection($rules);
        $violations = $validator->validate($data, $constraints);
        $newViolationArray = [];
        foreach ($violations as $violation) {
            /** @var $violation ConstraintViolation */
            $name = trim($violation->getPropertyPath(), '[]');
            $newViolationArray[] = new ConstraintViolation($violation->getMessage(), $violation->getMessageTemplate(), $violation->getParameters(), $violation->getRoot(), $name, $violation->getInvalidValue(), $violation->getPlural(), $violation->getCode(), $violation->getConstraint(), $violation->getCause());
        }
        return new ConstraintViolationList($newViolationArray);
    }

    public function createErrorCollectionFromViolationList(ConstraintViolationList $violations): Enumerable
    {
        $collection = new Collection();
        foreach ($violations as $violation) {
            //$name = trim($violation->getPropertyPath(), '[]');
            $name = $violation->getPropertyPath();
            $entity = new ValidationErrorEntity;
            $entity->setField($name);
            $entity->setMessage($violation->getMessage());
            $entity->setViolation($violation);
            $collection->add($entity);
        }
        return $collection;
    }
}
