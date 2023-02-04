<?php

namespace Untek\Domain\QueryFilter\Helpers;

use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Query\Entities\Where;
use Untek\Domain\QueryFilter\Exceptions\BadFilterValidateException;
use Untek\Domain\QueryFilter\Interfaces\DefaultSortInterface;
use Untek\Domain\QueryFilter\Interfaces\IgnoreAttributesInterface;
use Untek\Domain\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Domain\Validator\Helpers\ValidationHelper;

class FilterModelHelper
{

    public static function validate(object $filterModel)
    {
        try {
            ValidationHelper::validateEntity($filterModel);
        } catch (UnprocessibleEntityException $e) {
            $exception = new BadFilterValidateException();
            $exception->setErrorCollection($e->getErrorCollection());
            throw new $exception;
        }
    }

    public static function forgeCondition(Query $query, object $filterModel, array $attributesOnly)
    {
        $params = EntityHelper::toArrayForTablize($filterModel);
        if ($filterModel instanceof IgnoreAttributesInterface) {
            $filterParams = $filterModel->ignoreAttributesFromCondition();
            foreach ($params as $key => $value) {
                if (in_array($key, $filterParams)) {
                    unset($params[$key]);
                }
            }
        } else {
            $params = ArrayHelper::extractByKeys($params, $attributesOnly);
        }
        foreach ($params as $paramsName => $paramValue) {
            if ($paramValue !== null) {
                $query->whereNew(new Where($paramsName, $paramValue));
            }
        }
    }

    public static function forgeOrder(Query $query, object $filterModel)
    {
        $sort = $query->getParam(Query::ORDER);
        if (empty($sort) && $filterModel instanceof DefaultSortInterface) {
            $sort = $filterModel->defaultSort();
            $query->orderBy($sort);
        }
    }
}
