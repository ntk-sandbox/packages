<?php

namespace ZnSandbox\Sandbox\RpcMock\Domain\Facades;

use ZnCore\Container\Helpers\ContainerHelper;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnSandbox\Sandbox\RpcMock\Domain\Entities\MethodEntity;
use ZnSandbox\Sandbox\RpcMock\Domain\Enums\Rbac\RpcMockHandleMethodPermissionEnum;
use ZnSandbox\Sandbox\RpcMock\Domain\Interfaces\Repositories\MethodRepositoryInterface;
use ZnSandbox\Sandbox\RpcMock\Rpc\Controllers\HandleController;

class RpcMockFacade
{

    /*public static function persist(RpcRequestEntity $rpcRequestEntity): void
    {
        $entity = new MethodEntity();
        $entity->setMethodName($rpcRequestEntity->getMethod());
//        $entity->setIsRequireAuth(false);
        $entity->setIsRequireAuth($rpcRequestEntity->getMetaItem('meta.Authorization') != null);
        $entity->setRequest(
            [
                'body' => $rpcRequestEntity->getParams(),
                'meta' => $rpcRequestEntity->getMeta(),
            ]
        );
        $entity->setVersion($rpcRequestEntity->getMetaItem('version'));
        $em = ContainerHelper::getContainer()->get(EntityManagerInterface::class);
        $em->persist($entity);
    }*/

    public static function findAllRoutes(): array
    {
        $fixture = [];
        /** @var MethodRepositoryInterface $methodRepository */
        $methodRepository = ContainerHelper::getContainer()->get(MethodRepositoryInterface::class);

        /** @var MethodEntity[] $methodCollection */
        $methodCollection = $methodRepository->findAll();

        $uniqueMethodList = [];

        foreach ($methodCollection as $methodEntity) {
            $uniqueKey = $methodEntity->getVersion() . '/' . $methodEntity->getMethodName();
            if(!in_array($uniqueKey, $uniqueMethodList)) {
                $item = self::forgeFixtureItem($methodEntity);
                $fixture[] = $item;
                $uniqueMethodList[] = $uniqueKey;
            }
//        $methodRepository->update($methodEntity);

        }
        return $fixture;
    }

    private static function forgeFixtureItem(MethodEntity $methodEntity) {
        return [
            'method_name' => $methodEntity->getMethodName(),
            'version' => $methodEntity->getVersion(),
            'is_verify_eds' => false,
            'is_verify_auth' => $methodEntity->getIsRequireAuth(),
            'permission_name' => RpcMockHandleMethodPermissionEnum::HANDLE,
            'handler_class' => HandleController::class,
            'handler_method' => 'handle',
            'status_id' => 100,
            'title' => null,
            'description' => null,
        ];
    }
}
