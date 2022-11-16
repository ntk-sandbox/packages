<?php

namespace ZnLib\Components\DynamicEntity\Libs\Validators;

use ZnLib\Components\DynamicEntity\Helpers\DynamicEntityValidationHelper;
use ZnLib\Components\DynamicEntity\Interfaces\ValidateDynamicEntityInterface;
use ZnDomain\Validator\Interfaces\ValidatorInterface;
use ZnDomain\Validator\Libs\Validators\BaseValidator;

class DynamicEntityValidator extends BaseValidator implements ValidatorInterface
{

    public function validateEntity(object $entity): void
    {
        $errorCollection = DynamicEntityValidationHelper::validate($data);
        $this->handleResult($errorCollection);
    }

    public function isMatch(object $entity): bool
    {
        return $entity instanceof ValidateDynamicEntityInterface;
    }
}
