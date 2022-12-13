<?php

namespace ZnCore\Contract\Rbac\Interfaces;

/**
 * Возможность получения древа наследования полномочий RBAC
 * 
 * Например, можно заранее определить все CRUD-полномочия в один и далее компактно и лаконично его использовать.
 * Также, можно назначать полномочия системным ролям.
 */
interface GetRbacInheritanceInterface
{

    /**
     * Получить древо наследования
     * @return array
     */
    public static function getInheritance();
}
