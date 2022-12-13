<?php

namespace ZnDomain\Service\Interfaces;

use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnDomain\Query\Entities\Query;

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