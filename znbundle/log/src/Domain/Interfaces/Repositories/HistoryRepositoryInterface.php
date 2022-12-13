<?php

namespace ZnBundle\Log\Domain\Interfaces\Repositories;

use ZnDomain\Domain\Interfaces\GetEntityClassInterface;
use ZnDomain\Domain\Interfaces\ReadAllInterface;
use ZnDomain\Repository\Interfaces\FindOneInterface;
use ZnDomain\Repository\Interfaces\RepositoryInterface;

interface HistoryRepositoryInterface extends RepositoryInterface, GetEntityClassInterface, ReadAllInterface, FindOneInterface
{


}
