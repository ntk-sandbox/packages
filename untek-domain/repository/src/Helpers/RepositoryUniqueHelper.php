<?php

namespace Untek\Domain\Repository\Helpers;

use Untek\Core\Instance\Helpers\PropertyHelper;
use Untek\Core\Text\Helpers\Inflector;
use Untek\Domain\Entity\Interfaces\UniqueInterface;
use Untek\Domain\Query\Entities\Query;

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
