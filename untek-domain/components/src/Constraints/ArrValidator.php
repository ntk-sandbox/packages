<?php

namespace Untek\Model\Components\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use Untek\Model\Validator\Constraints\BaseValidator;

class ArrValidator extends BaseValidator
{

    protected $constraintClass = Arr::class;

    public function validate($value, Constraint $constraint)
    {
        if ($value && !is_array($value)) {
            // throw this exception if your validator cannot handle the passed type so that it can be marked as invalid
            throw new UnexpectedValueException($value, 'array');

            // separate multiple types using pipes
            // throw new UnexpectedValueException($value, 'string|int');
        }
    }
}
