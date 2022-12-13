<?php

namespace ZnUser\Rbac\Domain\Interfaces\Services;

interface ManagerServiceInterface
{

    /**
     * Получить вложенные роли и полномочия для массива ролей
     * @param array $roleNames Массив имен ролей
     * @return array
     */
    public function allNestedItemsByRoleNames(array $roleNames): array;

}
