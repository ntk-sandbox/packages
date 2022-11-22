<?php

namespace ZnUser\Authentication\Domain\Traits;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use ZnCore\Contract\User\Interfaces\Entities\IdentityEntityInterface;

/**
 * Работа с сущностью аутентифицированного пользователя
 *
 * Используется упрощения работы с пользователем в классах.
 */
trait GetUserTrait
{

    private Security $security;

    /**
     * Получить сущность аккаунта
     * @return IdentityEntityInterface
     */
    public function getUser(): ?IdentityEntityInterface
    {
        $identityEntity = $this->security->getUser();
        if ($identityEntity == null) {
            throw new AuthenticationException();
        }
        return $identityEntity;
    }

    protected function setSecurity(Security $security)
    {
        $this->security = $security;
    }
}
