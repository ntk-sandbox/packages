<?php

namespace Untek\Model\Service\Interfaces;

use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Model\Entity\Interfaces\EntityIdInterface;
use Untek\Model\Query\Entities\Query;

interface FindOneInterface
{

    /**
     * Получить одну сущность по ID
     * @param $id int ID сущности
     * @param Query|null $query Объект запроса
     * @return object|EntityIdInterface
     * @throws NotFoundException
     */
    public function findOneById($id, Query $query = null): EntityIdInterface;
}