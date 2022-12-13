<?php

namespace ZnUser\Authentication\Domain\Events;

use Symfony\Contracts\EventDispatcher\Event;
use ZnUser\Authentication\Domain\Forms\AuthForm;
use ZnCore\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use ZnCore\EventDispatcher\Traits\EventSkipHandleTrait;

class AuthEvent extends Event
{

    use EventSkipHandleTrait;

    private $loginForm;
    private $identityEntity;

    public function __construct(AuthForm $loginForm)
    {
        $this->loginForm = $loginForm;
    }

    public function getLoginForm(): AuthForm
    {
        return $this->loginForm;
    }

    public function getIdentityEntity(): ?IdentityEntityInterface
    {
        return $this->identityEntity;
    }

    public function setIdentityEntity(IdentityEntityInterface $identityEntity): void
    {
        $this->identityEntity = $identityEntity;
    }
}
