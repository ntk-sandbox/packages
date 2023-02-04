<?php

namespace Untek\User\Rbac\Domain\Repositories\File;

use Untek\Domain\Components\FileRepository\Base\BaseFileCrudRepository;
use Untek\User\Rbac\Domain\Entities\InheritanceEntity;
use Untek\User\Rbac\Domain\Interfaces\Repositories\InheritanceRepositoryInterface;

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
