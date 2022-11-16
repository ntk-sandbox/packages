<?php

namespace ZnDomain\Repository\Interfaces;

use ZnDomain\Domain\Interfaces\GetEntityClassInterface;
use ZnDomain\Domain\Interfaces\ReadAllInterface;

interface ReadRepositoryInterface extends
    RepositoryInterface, GetEntityClassInterface, ReadAllInterface, FindOneInterface//, RelationConfigInterface
{


}