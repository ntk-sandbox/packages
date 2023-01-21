<?php

namespace ZnCore\DotEnv\Domain\Interfaces;

interface BootstrapInterface
{

    public function getMode(): string;

    public function getRootDirectory(): string;

    public function loadFromPath(string $basePath = null, array $names = null): void;

    public function loadFromArray(array $env): void;

    public function loadFromContent(string $content): void;
}
