<?php

namespace Untek\Tool\Package\Domain\Interfaces\Repositories;

use Untek\Domain\Domain\Interfaces\GetEntityClassInterface;
use Untek\Domain\Domain\Interfaces\ReadAllInterface;
use Untek\Domain\Repository\Interfaces\FindOneInterface;
//use Untek\Domain\Repository\Interfaces\RelationConfigInterface;
use Untek\Domain\Repository\Interfaces\RepositoryInterface;

interface PackageRepositoryInterface extends RepositoryInterface, GetEntityClassInterface, ReadAllInterface, FindOneInterface//, RelationConfigInterface
{

}
