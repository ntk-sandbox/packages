<?php

namespace ZnDomain\Domain\Interfaces;

use ZnCore\Collection\Interfaces\Enumerable;
use ZnDomain\Query\Entities\Query;

interface FindAllInterface
{

    /**
     * Получить коллекцию сущностей из хранилища
     * @param Query|null $query Объект запроса
     * @return Enumerable|array
     */
    public function findAll(Query $query = null): Enumerable;

}
