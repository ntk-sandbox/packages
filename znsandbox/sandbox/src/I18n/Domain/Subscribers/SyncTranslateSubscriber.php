<?php

namespace ZnSandbox\Sandbox\I18n\Domain\Subscribers;

use App\Workshop\Domain\Entities\CategoryEntity;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use ZnCore\Code\Helpers\PropertyHelper;
use ZnDomain\Domain\Enums\EventEnum;
use ZnDomain\Domain\Events\EntityEvent;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\EntityManager\Traits\EntityManagerAwareTrait;
use ZnSandbox\Sandbox\I18n\Domain\Interfaces\Services\TranslateServiceInterface;

class SyncTranslateSubscriber implements EventSubscriberInterface
{

    use EntityManagerAwareTrait;

    public $attribute = null;

    private $translateService;

    public function __construct(
        EntityManagerInterface $entityManager,
        TranslateServiceInterface $translateService
    )
    {
        $this->setEntityManager($entityManager);
        $this->translateService = $translateService;
    }

    public static function getSubscribedEvents()
    {
        return [
            EventEnum::AFTER_CREATE_ENTITY => 'onAfterUpdateOrCreate',
            EventEnum::AFTER_UPDATE_ENTITY => 'onAfterUpdateOrCreate',
            EventEnum::AFTER_DELETE_ENTITY => 'onAfterDelete',
        ];
    }

    public function onAfterUpdateOrCreate(EntityEvent $event)
    {
        $entity = $event->getEntity();
        $i18nArray = PropertyHelper::getValue($entity, $this->attribute);
        $entityTypeId = $this->getTypeId($entity);
        $this->translateService->batchPersist($entityTypeId, $entity->getId(), $i18nArray);
    }

    public function onAfterDelete(EntityEvent $event)
    {
        /** @var EntityIdInterface $entity */
        $entity = $event->getEntity();
        $entityTypeId = $this->getTypeId($entity);
        $this->translateService->removeByUnique($entityTypeId, $entity->getId());
    }

    private function getTypeId(object $entity): int
    {
        $className = get_class($entity);
        $assoc = [
            CategoryEntity::class => 10,
        ];
        return $assoc[$className];
    }
}
