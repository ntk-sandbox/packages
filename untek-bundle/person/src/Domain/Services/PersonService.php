<?php

namespace Untek\Bundle\Person\Domain\Services;

use Untek\Bundle\Person\Domain\Entities\PersonEntity;
use Untek\Bundle\Person\Domain\Interfaces\Services\PersonServiceInterface;
use Untek\Model\Validator\Helpers\ValidationHelper;

class PersonService implements PersonServiceInterface
{

    public function update(PersonEntity $personEntity)
    {
        ValidationHelper::validateEntity($personEntity);

    }
}
