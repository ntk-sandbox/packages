<?php

namespace Untek\Domain\Repository\Interfaces;

use Untek\Domain\Domain\Interfaces\GetEntityClassInterface;
use Untek\Domain\Domain\Interfaces\ReadAllInterface;

interface ReadRepositoryInterface extends
    RepositoryInterface, GetEntityClassInterface, ReadAllInterface, FindOneInterface//, RelationConfigInterface
{


}