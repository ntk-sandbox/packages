<?php

namespace Untek\Domain\Components\SoftDelete\Traits\Service;

trait SoftRestoreTrait
{

    public function restoreById($id)
    {
        $entity = $this->findOneById($id);
        $entity->restore();
        $this->getRepository()->update($entity);
        return true;
    }
}
