<?php

namespace ZnUser\Rbac\Domain\Repositories\File;

use ZnDomain\Components\FileRepository\Base\BaseFileCrudRepository;
use ZnUser\Rbac\Domain\Entities\InheritanceEntity;
use ZnUser\Rbac\Domain\Interfaces\Repositories\InheritanceRepositoryInterface;

class InheritanceRepository extends BaseFileCrudRepository implements InheritanceRepositoryInterface
{

    private $fileName = __DIR__ . '/../../../../../../../fixtures/rbac_inheritance.php';
    
    public function getEntityClass(): string
    {
        return InheritanceEntity::class;
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
