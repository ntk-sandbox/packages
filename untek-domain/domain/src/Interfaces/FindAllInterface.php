<?php

namespace Untek\Model\Shared\Interfaces;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Model\Query\Entities\Query;

interface FindAllInterface
{

    /**
     * Получить коллекцию сущностей из хранилища
     * @param Query|null $query Объект запроса
     * @return Enumerable|array
     */
    public function findAll(Query $query = null): Enumerable;

}
