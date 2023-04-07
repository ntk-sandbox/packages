<?php

namespace Untek\User\Person\Domain\Services;

use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Model\Entity\Helpers\EntityHelper;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\User\Person\Domain\Entities\PersonEntity;
use Untek\User\Person\Domain\Interfaces\Repositories\PersonRepositoryInterface;
use Untek\User\Person\Domain\Interfaces\Services\PersonServiceInterface;

/**
 * @method PersonRepositoryInterface getRepository()
 */
class PersonService extends BaseCrudService implements PersonServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass(): string
    {
        return PersonEntity::class;
    }

    public function persist(object $entity)
    {
        try {
            $uniqueEntity = $this->getEntityManager()->findOneByUnique($entity);
            EntityHelper::setAttributesFromObject($uniqueEntity, $entity);
        } catch (NotFoundException $e) {}
        parent::persist($entity);
    }
}
