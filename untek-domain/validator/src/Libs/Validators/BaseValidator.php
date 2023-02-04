<?php

namespace Untek\Domain\Validator\Libs\Validators;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Domain\Validator\Exceptions\UnprocessibleEntityException;

class BaseValidator
{

    protected function handleResult(?Enumerable $errorCollection): void
    {
        if ($errorCollection && $errorCollection->count() > 0) {
            $exception = new UnprocessibleEntityException;
            $exception->setErrorCollection($errorCollection);
            throw $exception;
        }
    }
}
