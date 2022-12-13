<?php

namespace ZnFramework\Wsdl\Domain\Interfaces\Repositories;

use ZnFramework\Wsdl\Domain\Entities\ServiceEntity;

interface ServiceRepositoryInterface
{

    public function findOneByName(string $appName): ServiceEntity;
}

