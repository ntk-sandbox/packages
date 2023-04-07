<?php

namespace Untek\Model\Repository\Helpers;

use Untek\Core\Instance\Helpers\PropertyHelper;
use Untek\Core\Text\Helpers\Inflector;
use Untek\Model\Entity\Interfaces\UniqueInterface;
use Untek\Model\Query\Entities\Query;

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
