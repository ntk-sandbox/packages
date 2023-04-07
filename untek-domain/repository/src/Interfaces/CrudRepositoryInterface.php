<?php

namespace Untek\Model\Repository\Interfaces;

use Untek\Model\Shared\Interfaces\GetEntityClassInterface;
use Untek\Model\Shared\Interfaces\ReadAllInterface;

interface CrudRepositoryInterface extends RepositoryInterface, GetEntityClassInterface, ReadAllInterface, FindOneInterface, ModifyInterface//, RelationConfigInterface
{

}
