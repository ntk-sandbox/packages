<?php

namespace Untek\User\Password\Domain\Helpers;

use Untek\User\Password\Domain\Interfaces\Services\PasswordValidatorServiceInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Untek\Core\Container\Helpers\ContainerHelper;
use Untek\Model\Validator\Exceptions\UnprocessibleEntityException;

class PasswordValidatorHelper
{

    public static function createConstraint(): Constraint
    {
        $callback = function ($object, ExecutionContextInterface $context) {
            /** @var PasswordValidatorServiceInterface $passwordValidatorService */
            $passwordValidatorService = ContainerHelper::getContainer()->get(PasswordValidatorServiceInterface::class);
            try {
                $passwordValidatorService->validate($object);
            } catch (UnprocessibleEntityException $e) {
                foreach ($e->getErrorCollection() as $ValidationErrorEntity) {
                    $context->addViolation($ValidationErrorEntity->getMessage());
                }
            }
            return false;
        };
        return new Callback($callback);
    }
}
