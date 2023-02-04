<?php

namespace Untek\Framework\Rpc\Domain\Interfaces\Services;

use Untek\Core\Contract\User\Interfaces\Entities\IdentityEntityInterface;

interface IpServiceInterface
{

    public function isAvailable($ip, IdentityEntityInterface $identityEntity);
}
