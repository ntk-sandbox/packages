<?php

namespace ZnBundle\Person\Domain\Interfaces\Services;

use ZnBundle\Person\Domain\Entities\PersonEntity;
use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;

interface PersonServiceInterface
{

    /**
     * @param PersonEntity $personEntity
     * @throws UnprocessibleEntityException
     */
    public function update(PersonEntity $personEntity);
}
