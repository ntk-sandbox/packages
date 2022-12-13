<?php

namespace ZnDomain\Repository\Interfaces;

use ZnDomain\Domain\Interfaces\GetEntityClassInterface;
use ZnDomain\Domain\Interfaces\ReadAllInterface;

interface CrudRepositoryInterface extends RepositoryInterface, GetEntityClassInterface, ReadAllInterface, FindOneInterface, ModifyInterface//, RelationConfigInterface
{

}
