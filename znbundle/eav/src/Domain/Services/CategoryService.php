<?php

namespace ZnBundle\Eav\Domain\Services;

use ZnBundle\Eav\Domain\Entities\CategoryEntity;
use ZnBundle\Eav\Domain\Interfaces\Repositories\CategoryRepositoryInterface;
use ZnBundle\Eav\Domain\Interfaces\Services\CategoryServiceInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Query\Entities\Query;

/**
 * Class CategoryService
 * @package ZnBundle\Eav\Domain\Services
 * @method CategoryRepositoryInterface getRepository()
 */
class CategoryService extends BaseCrudService implements CategoryServiceInterface
{

    public function __construct(
        CategoryRepositoryInterface $repository,
        EntityManagerInterface $entityManager
    )
    {
        $this->setRepository($repository);
        $this->setEntityManager($entityManager);
    }

    public function findOneByName(string $name): CategoryEntity
    {
        return $this->getRepository()->findOneByName($name);
    }
}
