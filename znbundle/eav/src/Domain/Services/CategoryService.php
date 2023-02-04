<?php

namespace Untek\Bundle\Eav\Domain\Services;

use Untek\Bundle\Eav\Domain\Entities\CategoryEntity;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\CategoryRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Services\CategoryServiceInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Query\Entities\Query;

/**
 * Class CategoryService
 * @package Untek\Bundle\Eav\Domain\Services
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
