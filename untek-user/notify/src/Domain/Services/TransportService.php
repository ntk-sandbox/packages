<?php

namespace Untek\User\Notify\Domain\Services;

use Untek\Core\Instance\Exceptions\NotInstanceOfException;
use Untek\Core\Instance\Helpers\ClassHelper;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\User\Notify\Domain\Entities\NotifyEntity;
use Untek\User\Notify\Domain\Entities\TransportEntity;
use Untek\User\Notify\Domain\Interfaces\Libs\ContactDriverInterface;
use Untek\User\Notify\Domain\Interfaces\Repositories\TransportRepositoryInterface;
use Untek\User\Notify\Domain\Interfaces\Services\TransportServiceInterface;

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
