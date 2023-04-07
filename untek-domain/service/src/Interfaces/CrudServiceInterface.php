<?php

namespace Untek\Model\Service\Interfaces;

use Untek\Model\Shared\Interfaces\GetEntityClassInterface;
use Untek\Model\Shared\Interfaces\ReadAllInterface;

interface CrudServiceInterface extends ServiceDataProviderInterface, ServiceInterface, GetEntityClassInterface, ReadAllInterface, FindOneInterface, ModifyInterface
{


}