<?php

namespace ZnUser\Password\Domain\Interfaces\Services;

use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnUser\Password\Domain\Entities\PasswordValidatorEntity;

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
