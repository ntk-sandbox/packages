<?php

namespace Untek\Model\QueryFilter\Helpers;

use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Model\Entity\Helpers\EntityHelper;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Query\Entities\Where;
use Untek\Model\QueryFilter\Exceptions\BadFilterValidateException;
use Untek\Model\QueryFilter\Interfaces\DefaultSortInterface;
use Untek\Model\QueryFilter\Interfaces\IgnoreAttributesInterface;
use Untek\Model\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Model\Validator\Helpers\ValidationHelper;

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
