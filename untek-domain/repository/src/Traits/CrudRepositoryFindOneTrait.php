<?php

namespace Untek\Domain\Repository\Traits;

use Untek\Core\Code\Factories\PropertyAccess;
use Untek\Core\Instance\Helpers\PropertyHelper;
use Untek\Core\Contract\Common\Exceptions\InvalidMethodParameterException;
use Untek\Core\Text\Helpers\Inflector;
use Untek\Domain\Domain\Enums\EventEnum;
use Untek\Domain\Entity\Exceptions\AlreadyExistsException;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;
use Untek\Domain\Entity\Interfaces\UniqueInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\Lib\I18Next\Facades\I18Next;

trait CrudRepositoryFindOneTrait
{

    protected $primaryKey = ['id'];

    public function findOneById($id, Query $query = null): EntityIdInterface
    {
        if (empty($id)) {
            throw (new InvalidMethodParameterException('Empty ID'))
                ->setParameterName('id');
        }
        $query = $this->forgeQuery($query);
        $query->where($this->primaryKey[0], $id);
        $entity = $this->findOne($query);
        return $entity;
    }

    public function findOne(Query $query = null): object
    {
        $query->limit(1);
        $collection = $this->findAll($query);
        if ($collection->count() < 1) {
            throw new NotFoundException('Not found entity!');
        }
        $entity = $collection->first();
        $event = $this->dispatchEntityEvent($entity, EventEnum::AFTER_READ_ENTITY);
        return $entity;
    }

    public function checkExists(EntityIdInterface $entity): void
    {
        try {
            /*if($entity instanceof UniqueInterface) {
                $existedEntity = $this->findOneByUnique($entity);
            } else {
                $isReadable = PropertyAccess::createPropertyAccessor()->isReadable($entity, 'id');
                if ($isReadable) {
                    $existedEntity = $this->findOneById(PropertyHelper::getValue($entity, 'id'));
                }
            }*/
            $existedEntity = $this->findOneByUnique($entity);
            if (!empty($existedEntity)) {
                $message = I18Next::t('core', 'domain.message.entity_already_exist');
                $e = new AlreadyExistsException($message);
                $e->setEntity($existedEntity);
                throw $e;
            }
        } catch (NotFoundException $e) {
        }
    }

    public function findOneByUnique(object $entity): EntityIdInterface
    {
        if($entity instanceof UniqueInterface) {
            $unique = $entity->unique();
            if (!empty($unique)) {
                foreach ($unique as $uniqueConfig) {
                    $oneEntity = $this->findOneByUniqueGroup($entity, $uniqueConfig);
                    if ($oneEntity) {
                        return $oneEntity;
                    }
                }
            }
        } else {

        }
        throw new NotFoundException();
    }

    private function findOneByUniqueGroup(object $entity, $uniqueConfig): ?EntityIdInterface
    {
        $query = new Query();
        foreach ($uniqueConfig as $uniqueName) {
            $value = PropertyHelper::getValue($entity, $uniqueName);
            if ($value === null) {
                return null;
            }
            $query->where(Inflector::underscore($uniqueName), $value);
        }
        $all = $this->findAll($query);
        if ($all->count() > 0) {
            return $all->first();
        }
        return null;
    }
}
