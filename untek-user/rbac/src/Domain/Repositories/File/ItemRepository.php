<?php

namespace Untek\User\Rbac\Domain\Repositories\File;

use Untek\User\Rbac\Domain\Entities\ItemEntity;
use Untek\User\Rbac\Domain\Entities\RoleEntity;
use Untek\User\Rbac\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use Untek\User\Rbac\Domain\Interfaces\Repositories\RoleRepositoryInterface;
use Untek\Domain\Components\FileRepository\Base\BaseFileCrudRepository;

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
