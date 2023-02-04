<?php

namespace Untek\User\Authentication\Domain\Events;

use Symfony\Contracts\EventDispatcher\Event;
use Untek\User\Authentication\Domain\Forms\AuthForm;
use Untek\Core\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use Untek\Core\EventDispatcher\Traits\EventSkipHandleTrait;

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
