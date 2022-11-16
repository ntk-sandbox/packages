<?php

namespace ZnFramework\Rpc\Domain\Interfaces\Services;

use ZnFramework\Rpc\Domain\Entities\DocEntity;

interface DocsServiceInterface
{

    public function findOneByName(string $name): DocEntity;
    public function loadByName(string $name): string;
}
