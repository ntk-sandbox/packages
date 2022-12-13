<?php

namespace ZnSandbox\Sandbox\Settings\Domain\Interfaces\Services;

use ZnDomain\Service\Interfaces\CrudServiceInterface;

interface SystemServiceInterface extends CrudServiceInterface
{

    public function view(string $name): array;

    public function update(string $name, array $data): void;
}
