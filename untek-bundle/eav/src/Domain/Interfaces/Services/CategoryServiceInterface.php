<?php

namespace Untek\Bundle\Eav\Domain\Interfaces\Services;

use Untek\Bundle\Eav\Domain\Entities\CategoryEntity;
use Untek\Model\Service\Interfaces\CrudServiceInterface;

interface CategoryServiceInterface extends CrudServiceInterface
{

    public function findOneByName(string $name): CategoryEntity;
}
