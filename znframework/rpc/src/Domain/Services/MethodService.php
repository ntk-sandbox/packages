<?php

namespace Untek\Framework\Rpc\Domain\Services;

use Untek\Framework\Rpc\Domain\Entities\MethodEntity;
use Untek\Framework\Rpc\Domain\Interfaces\Services\MethodServiceInterface;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Framework\Rpc\Domain\Exceptions\RpcMethodNotFoundException;

class MethodService extends BaseCrudService implements MethodServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass(): string
    {
        return MethodEntity::class;
    }

    public function findOneByMethodName(string $methodName, string $version): MethodEntity
    {
        try {
            $methodEntity = $this->getRepository()->findOneByMethodName($methodName, $version);
        } catch (NotFoundException $e) {
            if($methodName == 'fixture.import') {
                $methodEntity = $this->createFixtureMethod();
            } else {
                throw new RpcMethodNotFoundException('Not found RPC-method handler');
            }
        }
        return $methodEntity;
    }

    private function createFixtureMethod(): MethodEntity
    {
        $attributes = [
            'id' => 6,
            'method_name' => 'fixture.import',
            'version' => '1',
            'is_verify_eds' => false,
            'is_verify_auth' => false,
//          'permission_name' => 'oFixtureImport',
            'permission_name' => null,
            'handler_class' => 'Untek\Framework\Rpc\Rpc\Controllers\FixtureController',
            'handler_method' => 'import',
            'status_id' => 100,
            'title' => null,
            'description' => null,
        ];
        return $this->createEntity($attributes);
    }
}
