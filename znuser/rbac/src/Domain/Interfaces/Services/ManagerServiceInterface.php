<?php

namespace ZnUser\Rbac\Domain\Interfaces\Services;

use ZnCore\Contract\User\Exceptions\ForbiddenException;

interface ManagerServiceInterface
{

    /**
     * Имеет ли права текущий пользователь
     * @param array $permissionNames
     * @return bool
     */
    public function iCan(array $permissionNames): bool;

    /**
     * Проверка полномочий текущего пользователя
     * @param array $permissionNames
     * @throws ForbiddenException
     */
    public function checkMyAccess(array $permissionNames): void;
    
    /**
     * Проверка полномочий
     * @param array $roleNames Роли пользователя
     * @param array $permissionNames Полномочия
     * @throws ForbiddenException
     */
    public function checkAccess(array $roleNames, array $permissionNames): void;

    /**
     * Имеют ли полномочия указанные роли? (Да/Нет)
     * @param array $roleNames
     * @param array $permissionNames
     * @return bool
     */
    public function isCanByRoleNames(array $roleNames, array $permissionNames): bool;

    /**
     * Получить вложенные роли и полномочия для роли
     * @param string $roleName Имя роли
     * @return array
     */
    //public function allNestedItemsByRoleName(string $roleName): array;

    /**
     * Получить вложенные роли и полномочия для массива ролей
     * @param array $roleNames Массив имен ролей
     * @return array
     */
    public function allNestedItemsByRoleNames(array $roleNames): array;
}
