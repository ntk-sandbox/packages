<?php

namespace Untek\User\Password\Domain\Entities;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Model\Validator\Interfaces\ValidationByMetadataInterface;

class PasswordValidatorEntity implements ValidationByMetadataInterface
{

    private $password = null;
    private static $_validator = [];
    private static $_callback = null;

    public function __construct(?string $password = null)
    {
        $this->setPassword($password);
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        if(self::$_callback) {
            call_user_func(self::$_callback, $metadata);
        }
        if(self::$_validator) {
            foreach (self::$_validator as $constraint) {
                $metadata->addPropertyConstraint('password', $constraint);
            }
        }
    }

    public static function clearValidator()
    {
        self::$_validator = [];
    }

    public static function addValidator(Constraint $constraint)
    {
        self::$_validator[] = $constraint;
    }

    public static function getCallback()
    {
        return self::$_callback;
    }

    public static function setCallback($callback): void
    {
        self::$_callback = $callback;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }
}
