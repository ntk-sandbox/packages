<?php

namespace Untek\Domain\Components\SoftDelete\Traits\Service;

trait SoftDeleteTrait
{

    public function deleteById($id)
    {
        $entity = $this->findOneById($id);
        $entity->delete();
        $this->getRepository()->update($entity);
        return true;
    }
}
