<?php

namespace Untek\Model\Repository\Interfaces;

use Untek\Model\Shared\Interfaces\GetEntityClassInterface;
use Untek\Model\Shared\Interfaces\ReadAllInterface;

interface ReadRepositoryInterface extends
    RepositoryInterface, GetEntityClassInterface, ReadAllInterface, FindOneInterface//, RelationConfigInterface
{


}