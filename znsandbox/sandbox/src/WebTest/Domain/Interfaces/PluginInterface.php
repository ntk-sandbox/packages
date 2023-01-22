<?php

namespace ZnSandbox\Sandbox\WebTest\Domain\Interfaces;

use ZnSandbox\Sandbox\WebTest\Domain\Dto\RequestDataDto;

interface PluginInterface
{

    public function run(RequestDataDto $requestDataDto): void;
}
