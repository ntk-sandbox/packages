<?php

namespace Untek\Sandbox\Sandbox\WebTest\Domain\Interfaces;

use Untek\Sandbox\Sandbox\WebTest\Domain\Dto\RequestDataDto;

interface PluginInterface
{

    public function run(RequestDataDto $requestDataDto): void;
}
