<?php

namespace Untek\User\Identity\Domain\Events;

use Symfony\Contracts\EventDispatcher\Event;
use Untek\Core\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use Untek\Core\EventDispatcher\Traits\EventSkipHandleTrait;

class IdentityEvent extends Event
{

    use EventSkipHandleTrait;

    private $identityEntity;
    private $isGuest = null;

    public function __construct(IdentityEntityInterface $identityEntity = null)
    {
        $this->identityEntity = $identityEntity;
    }

    public function getIdentityEntity(): ?IdentityEntityInterface
    {
        return $this->identityEntity;
    }

    public function setIdentityEntity(?IdentityEntityInterface $identityEntity): void
    {
        $this->identityEntity = $identityEntity;
    }

    public function getIsGuest(): ?bool
    {
        return $this->isGuest;
    }

    public function setIsGuest(bool $isGuest): void
    {
        $this->isGuest = $isGuest;
    }
}
