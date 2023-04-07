<?php

namespace Untek\Model\Repository\Interfaces;

use Untek\Core\Contract\Common\Exceptions\InvalidMethodParameterException;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Model\Entity\Interfaces\EntityIdInterface;
use Untek\Model\Entity\Interfaces\UniqueInterface;

interface FindOneUniqueInterface
{

    /**
     * @param UniqueInterface $entity
     * @return EntityIdInterface | object
     * @throws NotFoundException
     * @throws InvalidMethodParameterException
     */
    public function findOneByUnique(object $entity): EntityIdInterface;

}