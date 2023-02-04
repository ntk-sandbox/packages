<?php

namespace Untek\Bundle\Log\Domain\Interfaces\Repositories;

use Untek\Domain\Domain\Interfaces\GetEntityClassInterface;
use Untek\Domain\Domain\Interfaces\ReadAllInterface;
use Untek\Domain\Repository\Interfaces\FindOneInterface;
use Untek\Domain\Repository\Interfaces\RepositoryInterface;

interface HistoryRepositoryInterface extends RepositoryInterface, GetEntityClassInterface, ReadAllInterface, FindOneInterface
{


}
