<?php

namespace Untek\User\Person\Domain\Services;

use Untek\Bundle\Eav\Domain\Entities\AttributeEntity;
use Untek\Bundle\Eav\Domain\Interfaces\Services\EntityServiceInterface;
use Untek\Bundle\Person\Domain\Interfaces\Repositories\ContactRepositoryInterface;
use Untek\Domain\Entity\Exceptions\AlreadyExistsException;
use Untek\Core\Collection\Helpers\CollectionHelper;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Domain\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\User\Person\Domain\Entities\ContactEntity;
use Untek\User\Person\Domain\Interfaces\Services\ContactTypeServiceInterface;
use Untek\User\Person\Domain\Interfaces\Services\MyContactServiceInterface;
use Untek\User\Person\Domain\Interfaces\Services\MyPersonServiceInterface;

/**
 * @method ContactRepositoryInterface getRepository()
 */
class MyContactService extends ContactService implements MyContactServiceInterface
{

    private $myPersonService;

    public function __construct(
        EntityManagerInterface $em,
        MyPersonServiceInterface $myPersonService,
        ContactTypeServiceInterface $contactTypeService
    )
    {
        parent::__construct($em, $contactTypeService);
        $this->myPersonService = $myPersonService;
    }

    protected function forgeQuery(Query $query = null): Query
    {
        $query = parent::forgeQuery($query);
        $myPersonId = $this->myPersonService->findOne()->getId();
        $query->where('person_id', $myPersonId);
        return $query;
    }

    public function deleteById($id)
    {
        $this->findOneById($id);
        parent::deleteById($id);
    }

    public function updateById($id, $data)
    {
        $this->findOneById($id);
        return parent::updateById($id, $data);
    }

    public function createBatch($data): void
    {
        $typeCollection = $this->contactTypeService->findAll();
        $typeCollection = CollectionHelper::indexing($typeCollection, 'name');
        foreach ($data as $name => $values) {
            /** @var AttributeEntity $typeEntity */
            $typeEntity = $typeCollection[$name];
            foreach ($values as $value) {
                $contactType = new ContactEntity();
                /*$contactType->setAttributeId($value);
                $contactType->setValue($typeEntity->getId());
                $this->getEntityManager()->persist($contactType);*/

                $item = [
                    "value" => $value,
                    "attributeId" => $typeEntity->getId(),
                ];
                try {
                    $this->create($item);
                } catch (AlreadyExistsException $e) {
                    $errors = new UnprocessibleEntityException;
                    $errors->add($name, $e->getMessage());
                    throw $errors;
                }
            }
        }
    }

    public function create($data): EntityIdInterface
    {
        $myPersonId = $this->myPersonService->findOne()->getId();
        $data['person_id'] = $myPersonId;
        return parent::create($data);
    }
}
