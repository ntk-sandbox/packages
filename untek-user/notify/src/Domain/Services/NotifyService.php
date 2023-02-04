<?php

namespace Untek\User\Notify\Domain\Services;

use Untek\Domain\Validator\Helpers\ValidationHelper;
use Untek\Domain\Domain\Interfaces\GetEntityClassInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\EntityManager\Traits\EntityManagerAwareTrait;
use Untek\User\Notify\Domain\Entities\NotifyEntity;
use Untek\User\Notify\Domain\Interfaces\Services\NotifyServiceInterface;
use Untek\User\Notify\Domain\Interfaces\Services\TransportServiceInterface;
use Untek\User\Notify\Domain\Interfaces\Services\TypeServiceInterface;

class NotifyService implements NotifyServiceInterface, GetEntityClassInterface
{

    use EntityManagerAwareTrait;

    private $em;
    private $typeService;
    private $transportService;

    public function __construct(
        EntityManagerInterface $em,
        TypeServiceInterface $typeService,
        TransportServiceInterface $transportService
    )
    {
        $this->setEntityManager($em);
        $this->typeService = $typeService;
        $this->transportService = $transportService;
    }

    public function getEntityClass(): string
    {
        return NotifyEntity::class;
    }

    public function sendNotifyByTypeName(string $typeName, int $userId, array $attributes = [])
    {
        $typeEntity = $this->typeService->findOneByName($typeName);
        $this->getEntityManager()->loadEntityRelations($typeEntity, ['i18n']);
        $notifyEntity = $this->getEntityManager()->createEntity(NotifyEntity::class);
//        $notifyEntity = new NotifyEntity();
        $notifyEntity->setType($typeEntity);
        $notifyEntity->setRecipientId($userId);
        $notifyEntity->setTypeId($typeEntity->getId());
        $notifyEntity->setAttributes($attributes);
        $this->sendNotify($notifyEntity);
    }

    private function sendNotify(NotifyEntity $notifyEntity)
    {
        ValidationHelper::validateEntity($notifyEntity);
//        $typeEntity = $this->typeService->findOneByIdWithI18n($notifyEntity->getTypeId());
//        $notifyEntity->setType($typeEntity);
        $this->addAttributesFromEnv($notifyEntity);
        $this->transportService->send($notifyEntity);
    }

    private function addAttributesFromEnv(NotifyEntity $notifyEntity)
    {
        $envAttributes = [
            'api_url',
            'web_url',
            'admin_url',
            'storage_url',
            'static_url',
        ];
        foreach ($envAttributes as $name) {
            $upperName = strtoupper($name);
            if (getenv($upperName)) {
                $lowerName = strtolower($name);
                $value = rtrim(getenv($upperName), '/');
                $notifyEntity->addAttribute('env.' . $lowerName, $value);
            }
        }
    }
}
