<?php

namespace ZnCore\Contract\User\Interfaces\Entities;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Интерфейс сущности аккаунта пользователя
 * @todo Перенести в
 */
interface IdentityEntityInterface extends UserInterface
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
