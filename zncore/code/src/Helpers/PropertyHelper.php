<?php

namespace ZnCore\Code\Helpers;

use Throwable;
use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\Text\Helpers\Inflector;
use ZnCore\Code\Factories\PropertyAccess;

/**
 * Работа с атрибутами класса
 */
class PropertyHelper
{

    /**
     * Получить значение атрибута.
     *
     * @param object | array $entity
     * @param string $attribute
     * @param null $defaultValue
     * @return mixed
     */
    public static function getValue($entity, string $attribute, $defaultValue = null)
    {
        if(is_array($entity)) {
            return ArrayHelper::getValue($entity, $attribute);
        }

        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        try {
            return $propertyAccessor->getValue($entity, $attribute);
        } catch (Throwable $e) {
            // todo: логировать ошибки доступа к атрибутам
            return $defaultValue;
        }
    }

    /**
     * Установить значение атрибута.
     * 
     * @param object | array $entity
     * @param string $name
     * @param $value
     */
    public static function setValue(&$entity, string $name, $value): void
    {
        if(is_array($entity)) {
            ArrayHelper::set($entity, $name, $value);
            return;
        }

        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        $propertyAccessor->setValue($entity, $name, $value);
    }

    /**
     * Назначить массив атрибутов.
     * 
     * @param object | array $entity
     * @param array $data
     * @param array $filedsOnly
     */
    public static function setAttributes(&$entity, $data, array $filedsOnly = []): void
    {
        if (empty($data)) {
            return;
        }

        if(is_array($entity)) {
            $data = ArrayHelper::only($data);
            $entity = ArrayHelper::merge($entity, $data);
            return;
        }


        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        foreach ($data as $name => $value) {
            $name = Inflector::variablize($name);
            $isAllow = empty($filedsOnly) || in_array($name, $filedsOnly);
            if ($isAllow) {
                $isWritable = $propertyAccessor->isWritable($entity, $name);
                if ($isWritable) {
                    $propertyAccessor->setValue($entity, $name, $value);
                }
            }
        }
    }

    /**
     * Проверяет, доступен ли атрибут для записи.
     * 
     * @param object $entity
     * @param string $name
     * @return bool
     */
    public static function isWritableAttribute(object $entity, string $name): bool
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        return $propertyAccessor->isWritable($entity, $name);
    }

    /**
     * Проверяет, доступен ли атрибут для чтения.
     * 
     * @param object $entity
     * @param string $name
     * @return bool
     */
    public static function isReadableAttribute(object $entity, string $name): bool
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        return $propertyAccessor->isReadable($entity, $name);
    }
}
