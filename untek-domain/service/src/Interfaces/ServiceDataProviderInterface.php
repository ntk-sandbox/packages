<?php

namespace Untek\Domain\Service\Interfaces;

use Untek\Domain\DataProvider\Libs\DataProvider;
use Untek\Domain\Query\Entities\Query;

interface ServiceDataProviderInterface
{

    /**
     * Получить провайдер данных
     * @param Query|null $query Объект запроса
     * @return DataProvider
     */
    public function getDataProvider(Query $query = null): DataProvider;

}