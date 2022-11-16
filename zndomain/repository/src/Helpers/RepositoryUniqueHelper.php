<?php

namespace ZnDomain\Repository\Helpers;

use ZnCore\Code\Helpers\PropertyHelper;
use ZnCore\Text\Helpers\Inflector;
use ZnDomain\Entity\Interfaces\UniqueInterface;
use ZnDomain\Query\Entities\Query;

class RepositoryUniqueHelper
{

    public static function buildQuery(UniqueInterface $entity, array $uniqueConfig): Query
    {
        $query = new Query();
        foreach ($uniqueConfig as $uniqueName) {
            $value = PropertyHelper::getValue($entity, $uniqueName);
            if ($value === null) {
                return null;
            }
            $query->where(Inflector::underscore($uniqueName), $value);
        }
        return $query;
    }
}
