<?php

namespace Untek\Bundle\Person\Domain\Interfaces\Services;

use Untek\Bundle\Person\Domain\Entities\PersonEntity;
use Untek\Domain\Validator\Exceptions\UnprocessibleEntityException;

interface PersonServiceInterface
{

    /**
     * @param PersonEntity $personEntity
     * @throws UnprocessibleEntityException
     */
    public function update(PersonEntity $personEntity);
}
