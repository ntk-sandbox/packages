<?php

namespace ZnSandbox\Sandbox\WebTest\Domain\Interfaces;

interface PluginInterface
{
    
    public function run(array $requestData): array;
}
