<?php

namespace Untek\Framework\Wsdl\Domain\Interfaces\Repositories;

use Untek\Framework\Wsdl\Domain\Entities\ServiceEntity;

interface ServiceRepositoryInterface
{

    public function findOneByName(string $appName): ServiceEntity;
}

