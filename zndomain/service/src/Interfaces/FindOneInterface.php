<?php

namespace Untek\Domain\Service\Interfaces;

use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;
use Untek\Domain\Query\Entities\Query;

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