<?php

namespace Untek\Model\Repository\Interfaces;

use Untek\Core\Contract\Common\Exceptions\InvalidMethodParameterException;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Model\Entity\Interfaces\EntityIdInterface;
use Untek\Model\Query\Entities\Query;

interface FindOneInterface
{

    /**
     * @param $id
     * @param Query|null $query
     * @return EntityIdInterface | object
     * @throws NotFoundException
     * @throws InvalidMethodParameterException
     */
    public function findOneById($id, Query $query = null): EntityIdInterface;

}