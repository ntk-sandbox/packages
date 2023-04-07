<?php

namespace Untek\User\Notify\Domain\Services;

use Symfony\Component\Security\Core\Security;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\EntityManager\Traits\EntityManagerAwareTrait;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Query\Entities\Where;
use Untek\User\Authentication\Domain\Traits\GetUserTrait;
use Untek\User\Notify\Domain\Entities\SettingEntity;
use Untek\User\Notify\Domain\Interfaces\Services\SettingServiceInterface;

class SettingService /*extends BaseCrudService*/
    implements SettingServiceInterface
{

    use EntityManagerAwareTrait;
    use GetUserTrait;

    public function __construct(EntityManagerInterface $em, private Security $security)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass(): string
    {
        return SettingEntity::class;
    }

    protected function forgeQuery(Query $query = null): Query
    {
        $query = parent::forgeQuery($query);
        $userId = $this->getUser()->getId();
        $query->whereNew(new Where('user_id', $userId));
        return $query;
    }

    public function getSettingsByUserId(int $userId): array
    {
        $data = [];
        $settingsCollection = $this->allByUserId($userId);
        foreach ($settingsCollection as $settingsEntity) {
            $data[$settingsEntity->getNotifyTypeId()][$settingsEntity->getContactTypeId(
            )] = $settingsEntity->getIsEnabled();
        }
        return $data;
    }

    private function allByUserId(int $userId): Enumerable
    {
        $query = new Query();
        $query->whereNew(new Where('user_id', $userId));
        $query->with(['notifyType', 'contactType']);
        return $this->getEntityManager()->getRepository($this->getEntityClass())->findAll($query);
    }

    public function allByUserAndType(int $userId, int $typeId): Enumerable
    {
        $query = new Query();
        $query->whereNew(new Where('user_id', $userId));
        $query->whereNew(new Where('notify_type_id', $typeId));
        $query->with(['notifyType', 'contactType']);
        return $this->getEntityManager()->getRepository($this->getEntityClass())->findAll($query);
    }

    public function getMySettings(): array
    {
        $userId = $this->getUser()->getId();
        return $this->getSettingsByUserId($userId);
    }

    public function saveMySettings(array $data)
    {
        $userId = $this->getUser()->getId();
        foreach ($data as $typeId => $typeData) {
            foreach ($typeData as $contactTypeId => $value) {
                try {
                    $query = new Query();
                    $query->whereNew(new Where('notify_type_id', $typeId));
                    $query->whereNew(new Where('contact_type_id', $contactTypeId));
                    $query->whereNew(new Where('user_id', $userId));
                    $settingEntity = $this->getEntityManager()->getRepository($this->getEntityClass())->findOne($query);
                } catch (NotFoundException $e) {
                    $settingEntity = new SettingEntity();
                    $settingEntity->setNotifyTypeId($typeId);
                    $settingEntity->setContactTypeId($contactTypeId);
                    $settingEntity->setUserId($userId);
                }
                $settingEntity->setIsEnabled(boolval($value));
                $this->getEntityManager()->persist($settingEntity);
            }
        }
    }
}
