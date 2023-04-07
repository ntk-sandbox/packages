<?php

namespace Untek\User\Password\Domain\Interfaces\Services;

use Untek\Model\Validator\Exceptions\UnprocessibleEntityException;
use Untek\User\Password\Domain\Entities\PasswordValidatorEntity;

interface PasswordValidatorServiceInterface
{
    /**
     * Валидация пароля
     * @param PasswordValidatorEntity $passwordEntity
     * @throws UnprocessibleEntityException
     */
    public function validateEntity(PasswordValidatorEntity $passwordEntity): void;

    /**
     * Валидация пароля
     * @param string $password
     * @throws UnprocessibleEntityException
     */
    public function validate(?string $password): void;
}
