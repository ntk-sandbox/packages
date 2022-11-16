<?php

namespace ZnUser\Rbac\Domain\Repositories\File;

use ZnUser\Rbac\Domain\Entities\ItemEntity;
use ZnUser\Rbac\Domain\Entities\RoleEntity;
use ZnUser\Rbac\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use ZnUser\Rbac\Domain\Interfaces\Repositories\RoleRepositoryInterface;
use ZnDomain\Components\FileRepository\Base\BaseFileCrudRepository;

class ItemRepository extends BaseFileCrudRepository implements ItemRepositoryInterface
{

    private $fileName = __DIR__ . '/../../../../../../../fixtures/rbac_item.php';

    public function getEntityClass(): string
    {
        return ItemEntity::class;
    }

    public function setFileName(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function fileName(): string
    {
        return $this->fileName;
    }

    protected function getItems(): array
    {
        return parent::getItems()['collection'];
    }
}
