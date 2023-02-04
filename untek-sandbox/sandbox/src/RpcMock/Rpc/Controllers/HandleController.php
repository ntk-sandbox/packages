<?php

namespace Untek\Sandbox\Sandbox\RpcMock\Rpc\Controllers;

use Untek\Core\Container\Helpers\ContainerHelper;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Framework\Rpc\Domain\Enums\RpcErrorCodeEnum;
use Untek\Framework\Rpc\Rpc\Base\BaseRpcController;
use Untek\Sandbox\Sandbox\RpcMock\Domain\Entities\MethodEntity;
use Untek\Sandbox\Sandbox\RpcMock\Domain\Interfaces\Services\MethodServiceInterface;
use Untek\Sandbox\Sandbox\RpcMock\Domain\Libs\HasherHelper;

class HandleController extends BaseRpcController
{

    protected $service = null;

    public function __construct(MethodServiceInterface $service)
    {
        $this->service = $service;
    }

    public function handle(RpcRequestEntity $rpcRequestEntity): RpcResponseEntity
    {
        $methodName = $rpcRequestEntity->getMethod();
        $version = $rpcRequestEntity->getMetaItem('version');

        // todo: перенести логику выборки в репозиторий
        $query = new Query();
        $query->where('method_name', $methodName);
        $query->where('version', $version);

        /** @var MethodEntity[] $collection */
        $collection = $this->service->findAll($query);

        if ($rpcRequestEntity->getMeta()) {
            $meta = $rpcRequestEntity->getMeta();
            /*unset($meta['timestamp']);
            unset($meta['Authorization']);
            unset($meta['ip']);
            unset($meta['version']);*/
        } else {
            $meta = [];
        }

        $req = [];
        if ($rpcRequestEntity->getParams()) {
            $req['body'] = $rpcRequestEntity->getParams();
        }
        if ($meta) {
            $req['meta'] = $meta;
        }
        $hash = HasherHelper::generateDigest($req);
//        dump($req, $hash);


        if ($hash) {
            foreach ($collection as $ent) {
                if ($ent->getRequestHash() == $hash) {
                    $entity = $ent;
                }
            }
            if (empty($entity)) {
//                $entity = $collection->first();
                $entity = new MethodEntity();
                $entity->setError(
                    [
                        "code" => RpcErrorCodeEnum::APPLICATION_ERROR,
                        "message" => 'Not found magic response',
                    ]
                );
                $entity = new \Untek\Sandbox\Sandbox\RpcMock\Domain\Entities\MethodEntity();
                $entity->setMethodName($rpcRequestEntity->getMethod());
                $entity->setRequest(
                    [
                        'body' => $rpcRequestEntity->getParams(),
                        'meta' => $rpcRequestEntity->getMeta(),
                    ]
                );
//                $entity->setBody();
//                $entity->setMeta();
                $entity->setVersion($rpcRequestEntity->getMetaItem('version'));
                $em = ContainerHelper::getContainer()->get(EntityManagerInterface::class);
                $em->persist($entity);
            }
        } else {
            $entity = $collection->first();
        }


        /** @var MethodEntity $entity */

        $rpcResponse = new RpcResponseEntity();

        if ($entity->getBody()) {
            $rpcResponse->setResult($entity->getBody());
        }

        if ($entity->getMeta()) {
            $rpcResponse->setMeta($entity->getMeta());
        }

        if ($entity->getError()) {
            $rpcResponse->setError($entity->getError());
        }
//        dump($entity);
        return $rpcResponse;
    }
}
