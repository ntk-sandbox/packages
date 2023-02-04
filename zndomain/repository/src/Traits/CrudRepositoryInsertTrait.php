<?php

namespace Untek\Domain\Repository\Traits;

use Untek\Domain\Domain\Enums\EventEnum;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;
use Untek\Domain\Validator\Helpers\ValidationHelper;

trait CrudRepositoryInsertTrait
{

    abstract protected function insertRaw($entity): void;

    public function create(EntityIdInterface $entity)
    {
        ValidationHelper::validateEntity($entity);
        $event = $this->dispatchEntityEvent($entity, EventEnum::BEFORE_CREATE_ENTITY);
        if ($event->isPropagationStopped()) {
            return $entity;
        }
        $this->insertRaw($entity);
        $event = $this->dispatchEntityEvent($entity, EventEnum::AFTER_CREATE_ENTITY);
    }
}
