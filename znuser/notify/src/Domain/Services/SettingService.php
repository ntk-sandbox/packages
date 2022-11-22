<?php

namespace ZnUser\Notify\Domain\Services;

use Symfony\Component\Security\Core\Security;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnCore\Contract\User\Exceptions\UnauthorizedException;
use ZnCore\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\EntityManager\Traits\EntityManagerAwareTrait;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Query\Entities\Where;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use ZnUser\Notify\Domain\Entities\SettingEntity;
use ZnUser\Notify\Domain\Interfaces\Repositories\SettingRepositoryInterface;
use ZnUser\Notify\Domain\Interfaces\Services\SettingServiceInterface;

class SettingService /*extends BaseCrudService*/
    implements SettingServiceInterface
{

    use EntityManagerAwareTrait;

    private $authService;

    public function __construct(EntityManagerInterface $em, SettingRepositoryInterface $repository, AuthServiceInterface $authService, private Security $security)
    {
        $this->setEntityManager($em);
//        $this->repository = $repository;
        $this->authService = $authService;
    }

    public function getEntityClass(): string
    {
        return SettingEntity::class;
    }

    private function getUser(): ?IdentityEntityInterface {
        $identityEntity = $this->security->getUser();
        if($identityEntity == null) {
            throw new UnauthorizedException();
        }
        return $identityEntity;
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
            $data[$settingsEntity->getNotifyTypeId()][$settingsEntity->getContactTypeId()] = $settingsEntity->getIsEnabled();
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
//        $userId = $this->authService->getIdentity()->getId();
        return $this->getSettingsByUserId($userId);
    }

    public function saveMySettings(array $data)
    {
        $userId = $this->getUser()->getId();
//        $userId = $this->authService->getIdentity()->getId();
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
