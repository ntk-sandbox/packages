<?php

namespace Untek\Domain\Validator\Libs\Validators;

use Untek\Domain\Validator\Helpers\SymfonyValidationHelper;
use Untek\Domain\Validator\Interfaces\ValidationByMetadataInterface;
use Untek\Domain\Validator\Interfaces\ValidatorInterface;

class ClassMetadataValidator extends BaseValidator implements ValidatorInterface
{

    public function validateEntity(object $entity): void
    {
        $errorCollection = SymfonyValidationHelper::validate($entity);
        $this->handleResult($errorCollection);
    }

    public function isMatch(object $entity): bool
    {
        return $entity instanceof ValidationByMetadataInterface;
    }
}
