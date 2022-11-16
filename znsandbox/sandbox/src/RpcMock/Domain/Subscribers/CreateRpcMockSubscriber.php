<?php

namespace ZnSandbox\Sandbox\RpcMock\Domain\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use ZnCore\Env\Helpers\EnvHelper;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\EntityManager\Traits\EntityManagerAwareTrait;
use ZnFramework\Rpc\Domain\Enums\RpcEventEnum;
use ZnFramework\Rpc\Domain\Events\RpcRequestEvent;
use ZnSandbox\Sandbox\RpcMock\Domain\Entities\MethodEntity;

class CreateRpcMockSubscriber implements EventSubscriberInterface
{

    use EntityManagerAwareTrait;

    private $corsService;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->setEntityManager($entityManager);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RpcEventEnum::METHOD_NOT_FOUND => 'onMethodNotFound'
        ];
    }

    public function onMethodNotFound(RpcRequestEvent $event)
    {
        if (EnvHelper::isTest()) {
            return;
        }
        $rpcRequestEntity = $event->getRequestEntity();
//            RpcMockFacade::persist($event->getRequestEntity());
        $methodEntity = new MethodEntity();
        $methodEntity->setMethodName($rpcRequestEntity->getMethod());
        $methodEntity->setIsRequireAuth($rpcRequestEntity->getMetaItem('meta.Authorization') != null);
        $methodEntity->setRequest(
            [
                'body' => $rpcRequestEntity->getParams(),
                'meta' => $rpcRequestEntity->getMeta(),
            ]
        );
        $methodEntity->setVersion($rpcRequestEntity->getMetaItem('version'));
        $this->getEntityManager()->persist($methodEntity);
    }
}
