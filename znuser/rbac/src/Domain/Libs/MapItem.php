<?php

namespace ZnUser\Rbac\Domain\Libs;

use ZnCore\Enum\Helpers\EnumHelper;
use ZnCore\Instance\Helpers\ClassHelper;
use ZnCore\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnUser\Rbac\Domain\Entities\InheritanceEntity;
use ZnUser\Rbac\Domain\Entities\ItemEntity;
use ZnUser\Rbac\Domain\Enums\ItemTypeEnum;
use ZnUser\Rbac\Domain\Interfaces\InheritanceMapInterface;

class MapItem
{

    private $authItem;

    /** @var Enumerable */
    private $items;

    /** @var Enumerable */
    private $inheritance;

    public function __construct(InheritanceMapInterface $authItem)
    {
        $this->authItem = $authItem;
    }

    public function run()
    {
        $this->items = [];
        $this->inheritance = [];
        // Создание ролей
        foreach ($this->authItem->roleEnums() as $roleEnumClass) {
            $this->loadRolesFromEnum($roleEnumClass);
        }
        // Создание полномочий
        foreach ($this->authItem->permissionEnums() as $permissionEnumClass) {
            $this->loadPermissionsFromEnum($permissionEnumClass);
        }
        // Наследование
        foreach ($this->authItem->map() as $parentName => $childrenNames) {
            $this->addChildren($parentName, $childrenNames);
        }
        return [
            'items' => $this->items,
            'inheritance' => $this->inheritance,
        ];
    }

    protected function loadRolesFromEnum(string $enumClassName)
    {
        $itemNames = EnumHelper::getValues($enumClassName);
        foreach ($itemNames as $itemName) {
            $label = EnumHelper::getLabel($enumClassName, $itemName);
            $this->addRole($itemName, $label);
        }
        $this->assignInheritance($enumClassName);
    }

    protected function loadPermissionsFromEnum(string $enumClassName)
    {
        $itemNames = EnumHelper::getValues($enumClassName);
        foreach ($itemNames as $itemName) {
            $label = EnumHelper::getLabel($enumClassName, $itemName);
            $this->addPermission($itemName, $label);
        }
        $this->assignInheritance($enumClassName);
    }

    protected function assignInheritance(string $enumClassName)
    {
        if (ClassHelper::instanceOf($enumClassName, GetRbacInheritanceInterface::class, true)) {
            /** @var GetRbacInheritanceInterface $enumClassName */
            $inheritance = $enumClassName::getInheritance();
            foreach ($inheritance as $parentName => $children) {
                foreach ($children as $childName) {
                    $this->addChild($parentName, $childName);
                }
            }
        }
        /*try {
            ClassHelper::checkInstanceOf($enumClassName, GetRbacInheritanceInterface::class, true);

        } catch (NotInstanceOfException $e) {}*/
    }

    protected function addChildren(string $parentName, array $childNames)
    {
        foreach ($childNames as $childName) {
            $this->addItem($parentName);
            foreach ($childNames as $childName) {
                $this->addItem($childName);
                $this->addChild($parentName, $childName);
            }
        }
    }

    protected function addItem(string $name, string $description = null)
    {
        $itemEntity = new ItemEntity();
        $type = $name[0] == 'o' ? ItemTypeEnum::PERMISSION : ItemTypeEnum::ROLE;
        if ($type == ItemTypeEnum::PERMISSION) {
            $this->addPermission($name, $description);
        } elseif ($type == ItemTypeEnum::ROLE) {
            $this->addRole($name, $description);
        }
    }

    protected function addRole(string $name, string $description = null)
    {
        if (isset($this->items[$name])) {
            return;
        }
        $itemEntity = new ItemEntity();
        $itemEntity->setType(ItemTypeEnum::ROLE);
        $itemEntity->setName($name);
        $itemEntity->setTitle($description);
        $itemEntity->setId(count($this->items) + 1);
        $this->items[$name] = ($itemEntity);
    }

    protected function addPermission(string $name, string $description = null)
    {
        if (isset($this->items[$name])) {
            return;
        }
        $itemEntity = new ItemEntity();
        $itemEntity->setType(ItemTypeEnum::PERMISSION);
        $itemEntity->setName($name);
        $itemEntity->setTitle($description);
        $itemEntity->setId(count($this->items) + 1);
        $this->items[$name] = ($itemEntity);
    }

    protected function addChild(string $parentName, string $childName)
    {
        $name = $parentName . ',' . $childName;
        if (isset($this->inheritance[$name])) {
            return;
        }
        $inheritanceEntity = new InheritanceEntity();
        $inheritanceEntity->setParentName($parentName);
        $inheritanceEntity->setChildName($childName);
        $inheritanceEntity->setId(count($this->inheritance) + 1);
        $this->inheritance[$name] = $inheritanceEntity;
    }
}
