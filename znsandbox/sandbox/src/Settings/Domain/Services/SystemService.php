<?php

namespace ZnSandbox\Sandbox\Settings\Domain\Services;

use ZnSandbox\Sandbox\Settings\Domain\Entities\SystemEntity;
use ZnSandbox\Sandbox\Settings\Domain\Interfaces\Repositories\SystemRepositoryInterface;
use ZnSandbox\Sandbox\Settings\Domain\Interfaces\Services\SystemServiceInterface;
use ZnBundle\Eav\Domain\Interfaces\Services\EntityServiceInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;

/**
 * @method SystemRepositoryInterface getRepository()
 */
class SystemService extends BaseCrudService implements SystemServiceInterface
{

    private $entityService;
    private $systemRepository;

    public function __construct(
        EntityManagerInterface $em,
        EntityServiceInterface $entityService,
        SystemRepositoryInterface $systemRepository
    )
    {
        $this->setEntityManager($em);
        $this->entityService = $entityService;
        $this->systemRepository = $systemRepository;
    }

    public function getEntityClass(): string
    {
        return SystemEntity::class;
    }

    public function view(string $name): array
    {
        $collection = $this->systemRepository->allByName($name);
        $data = [];
        foreach ($collection as $systemEntity) {
            if($systemEntity->getKey()) {
                $data[$systemEntity->getKey()] = $systemEntity->getValue();
            }
        }
        return $data;
    }

    public function update(string $name, array $data): void
    {
        foreach ($data as $key => $value) {
            $systemEntity = new SystemEntity();
            $systemEntity->setName($name);
            $systemEntity->setKey($key);
            $systemEntity->setValue($value);
            $this->getEntityManager()->persist($systemEntity);
        }
    }

//    public function update(int $id, array $data)
//    {
//        $entity = $this->view($id);
//        $entity = $this->entityService->validate($id, $data);
//        $systemEntity = new SystemEntity();
//        $systemEntity->setEntityId($id);
//        $systemEntity->setValue(EntityHelper::toArray($entity));
//        $this->getEntityManager()->persist($systemEntity);
//    }
//
//    public function view(int $id)
//    {
//        try {
//            /** @var SystemEntity $systemEntity */
//            $systemEntity = $this->getRepository()->findOneByEntityId($id);
//            $value = $systemEntity->getValue();
//        } catch (NotFoundException $exception) {
//            $entity = $this->entityService->normalize($id);
//            $value = EntityHelper::toArray($entity);
//        }
//        return $value;
//    }
}
