<?php

namespace ZnCore\App\Libs;

use ZnCore\App\Interfaces\EnvironmentInterface;
use ZnCore\Container\Traits\ContainerAwareTrait;
use ZnCore\DotEnv\Domain\Libs\DotEnvLoader;
use ZnCore\DotEnv\Domain\Libs\DotEnvResolver;
use ZnCore\DotEnv\Domain\Libs\DotEnvWriter;

abstract class BaseEnvironment implements EnvironmentInterface
{

    use ContainerAwareTrait;

    abstract public function init(string $mode = null): void;

    protected function loadVars(array $env): void
    {
        $env = $this->getResolver()->resolve($env);
        $this->getWriter()->setAll($env);
    }

    protected function getResolver(): DotEnvResolver
    {
        /** @var DotEnvResolver $resolver */
        $resolver = $this->getContainer()->get(DotEnvResolver::class);
        return $resolver;
    }

    protected function getWriter(): DotEnvWriter
    {
        /** @var DotEnvWriter $writer */
        $writer = $this->getContainer()->get(DotEnvWriter::class);
        return $writer;
    }

    protected function getLoader(): DotEnvLoader
    {
        /** @var DotEnvLoader $loader */
        $loader = $this->getContainer()->get(DotEnvLoader::class);
        return $loader;
    }
}
