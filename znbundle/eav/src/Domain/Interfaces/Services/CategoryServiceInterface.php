<?php

namespace ZnBundle\Eav\Domain\Interfaces\Services;

use ZnBundle\Eav\Domain\Entities\CategoryEntity;
use ZnDomain\Service\Interfaces\CrudServiceInterface;

interface CategoryServiceInterface extends CrudServiceInterface
{

    public function findOneByName(string $name): CategoryEntity;
}
