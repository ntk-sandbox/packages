<?php

namespace Untek\Sandbox\Sandbox\RpcMock\Domain\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Untek\Core\Env\Helpers\EnvHelper;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\EntityManager\Traits\EntityManagerAwareTrait;
use Untek\Framework\Rpc\Domain\Enums\RpcEventEnum;
use Untek\Framework\Rpc\Domain\Events\RpcRequestEvent;
use Untek\Sandbox\Sandbox\RpcMock\Domain\Entities\MethodEntity;

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
