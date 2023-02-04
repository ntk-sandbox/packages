<?php

namespace Untek\Framework\Rpc\Domain\Repositories\File;

use Untek\Domain\Components\FileRepository\Base\BaseFileCrudRepository;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Relation\Libs\Types\OneToOneRelation;
use Untek\Framework\Rpc\Domain\Entities\MethodEntity;
use Untek\Framework\Rpc\Domain\Interfaces\Repositories\MethodRepositoryInterface;
use Untek\User\Rbac\Domain\Interfaces\Repositories\PermissionRepositoryInterface;

class MethodRepository extends BaseFileCrudRepository implements MethodRepositoryInterface
{

    public function fileName(): string
    {
        return __DIR__ . '/../../../../resources/fixtures/rpc_route.php';
    }

    public function getEntityClass(): string
    {
        return MethodEntity::class;
    }

    public function relations()
    {
        return [
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'permission_name',
                'relationEntityAttribute' => 'permission',
                'foreignAttribute' => 'name',
                'foreignRepositoryClass' => PermissionRepositoryInterface::class,
            ],
        ];
    }

    public function findOneByMethodName(string $method, int $version): MethodEntity
    {
//        dump($method,  $version);
        $query = new Query();
        $query->where('version', strval($version));
        $query->where('method_name', $method);
        return $this->findOne($query);
    }

    protected function getItems(): array
    {
        return parent::getItems()['collection'];
    }
}
