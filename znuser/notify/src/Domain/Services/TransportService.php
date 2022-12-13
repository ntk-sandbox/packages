<?php

namespace ZnUser\Notify\Domain\Services;

use ZnCore\Instance\Exceptions\NotInstanceOfException;
use ZnCore\Instance\Helpers\ClassHelper;
use ZnDomain\Service\Base\BaseCrudService;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnUser\Notify\Domain\Entities\NotifyEntity;
use ZnUser\Notify\Domain\Entities\TransportEntity;
use ZnUser\Notify\Domain\Interfaces\Libs\ContactDriverInterface;
use ZnUser\Notify\Domain\Interfaces\Repositories\TransportRepositoryInterface;
use ZnUser\Notify\Domain\Interfaces\Services\TransportServiceInterface;

/**
 * @method TransportRepositoryInterface getRepository()
 */
class TransportService extends BaseCrudService implements TransportServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass(): string
    {
        return TransportEntity::class;
    }

    public function send(NotifyEntity $notifyEntity)
    {
        $transportCollection = $this->getRepository()->allEnabledByTypeId($notifyEntity->getTypeId());
        foreach ($transportCollection as $transportEntity) {
            $driverInstance = ClassHelper::createObject($transportEntity->getHandlerClass());
            if ($driverInstance instanceof ContactDriverInterface) {
                $driverInstance->send($notifyEntity);
            } else {
                throw new NotInstanceOfException("Class \"{$transportEntity->getHandlerClass()}\" not instanceof \"ContactDriverInterface\"");
            }
        }
    }
}
