<?php

namespace Untek\Lib\Components\DynamicEntity\Libs\Validators;

use Untek\Lib\Components\DynamicEntity\Helpers\DynamicEntityValidationHelper;
use Untek\Lib\Components\DynamicEntity\Interfaces\ValidateDynamicEntityInterface;
use Untek\Model\Validator\Interfaces\ValidatorInterface;
use Untek\Model\Validator\Libs\Validators\BaseValidator;

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
