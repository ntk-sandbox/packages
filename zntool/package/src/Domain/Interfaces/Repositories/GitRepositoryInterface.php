<?php

namespace Untek\Tool\Package\Domain\Interfaces\Repositories;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Domain\Domain\Interfaces\GetEntityClassInterface;
use Untek\Tool\Package\Domain\Entities\PackageEntity;

interface GitRepositoryInterface extends GetEntityClassInterface
{

    public function isHasChanges(PackageEntity $packageEntity): bool;

    public function allChanged();

    public function allVersion(PackageEntity $packageEntity);

    public function allCommit(PackageEntity $packageEntity): Enumerable;

    public function allTag(PackageEntity $packageEntity): Enumerable;
}
