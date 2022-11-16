<?php

namespace ZnLib\Components\ReadOnly\Helpers;

use ZnCore\Contract\Common\Exceptions\ReadOnlyAttributeException;
use ZnCore\Contract\Common\Exceptions\ReadOnlyException;
use ZnCore\Instance\Helpers\ClassHelper;
use ZnDomain\Entity\Helpers\EntityHelper;

class ReadOnlyHelper
{

    /**
     * Проверка атрибута на запись
     * 
     * При запрете записи вызывает исключение.
     * @param $attributeValue
     * @param $value
     * @throws ReadOnlyException
     */
    public static function checkAttribute($attributeValue, $value, object $entity = null, string $attributeName = null)
    {
        if (isset($attributeValue) && $attributeValue !== $value) {
            $e = new ReadOnlyAttributeException();
            if($entity) {
                $e->setClass(get_class($entity));
            }
            if($attributeName){
                $e->setAttribute($attributeName);
            }
            throw $e;
        }
    }
}
