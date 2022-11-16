<?php

namespace ZnFramework\Rpc\Domain\Repositories\File;

use ZnDomain\Components\FileRepository\Base\BaseFileCrudRepository;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Relation\Libs\Types\OneToOneRelation;
use ZnFramework\Rpc\Domain\Entities\MethodEntity;
use ZnFramework\Rpc\Domain\Interfaces\Repositories\MethodRepositoryInterface;
use ZnUser\Rbac\Domain\Interfaces\Repositories\PermissionRepositoryInterface;

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
