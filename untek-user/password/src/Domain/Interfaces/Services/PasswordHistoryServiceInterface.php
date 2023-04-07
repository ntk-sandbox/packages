<?php

namespace Untek\User\Password\Domain\Interfaces\Services;

use Untek\Model\Service\Interfaces\CrudServiceInterface;

interface PasswordHistoryServiceInterface extends CrudServiceInterface
{

    public function isHas(string $password, int $identityId = null): bool;

    public function add(string $password, int $identityId = null);
}

