<?php

namespace Untek\Framework\Rpc\Domain\Interfaces\Services;

use Untek\Framework\Rpc\Domain\Entities\DocEntity;

interface DocsServiceInterface
{

    public function findOneByName(string $name): DocEntity;
    public function loadByName(string $name): string;
}
