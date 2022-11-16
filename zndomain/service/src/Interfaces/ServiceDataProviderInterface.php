<?php

namespace ZnDomain\Service\Interfaces;

use ZnDomain\DataProvider\Libs\DataProvider;
use ZnDomain\Query\Entities\Query;

interface ServiceDataProviderInterface
{

    /**
     * Получить провайдер данных
     * @param Query|null $query Объект запроса
     * @return DataProvider
     */
    public function getDataProvider(Query $query = null): DataProvider;

}