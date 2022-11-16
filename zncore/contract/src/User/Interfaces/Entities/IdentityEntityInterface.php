<?php

namespace ZnCore\Contract\User\Interfaces\Entities;

/**
 * Интерфейс сущности аккаунта пользователя
 * @todo Перенести в
 */
interface IdentityEntityInterface
{

    /**
     * ФИО или логин пользователя
     * @return string
     */
    public function getUsername(): string;

    /**
     * Сущность персоны
     * @return PersonEntityInterface|null
     */
    public function getPerson(): ?PersonEntityInterface;
}
