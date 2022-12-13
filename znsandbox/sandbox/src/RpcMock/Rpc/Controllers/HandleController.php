<?php

namespace ZnSandbox\Sandbox\RpcMock\Rpc\Controllers;

use ZnCore\Container\Helpers\ContainerHelper;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Query\Entities\Query;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Domain\Enums\RpcErrorCodeEnum;
use ZnFramework\Rpc\Rpc\Base\BaseRpcController;
use ZnSandbox\Sandbox\RpcMock\Domain\Entities\MethodEntity;
use ZnSandbox\Sandbox\RpcMock\Domain\Interfaces\Services\MethodServiceInterface;
use ZnSandbox\Sandbox\RpcMock\Domain\Libs\HasherHelper;

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
                $entity = new \ZnSandbox\Sandbox\RpcMock\Domain\Entities\MethodEntity();
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
