<?php

namespace Untek\Bundle\Summary\Domain\Interfaces\Services;

use Untek\Model\Entity\Exceptions\AlreadyExistsException;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Model\Service\Interfaces\CrudServiceInterface;

interface CounterServiceInterface extends CrudServiceInterface
{

    /**
     * @param string $entityName
     * @param int $entityId
     * @param string $type
     * @param bool $isUnique
     * @return int
     * @throws AlreadyExistsException
     */
    public function increment(string $entityName, int $entityId, string $type, bool $isUnique = false): int;

    /**
     * @param string $entityName
     * @param int $entityId
     * @param string $type
     * @param bool $isUnique
     * @return int
     * @throws NotFoundException
     */
    public function decrement(string $entityName, int $entityId, string $type, bool $isUnique = false): int;
}
