<?php

namespace Untek\Tool\Package\Domain\Entities;

use Untek\Tool\Package\Domain\Enums\StatusEnum;

class ChangedEntity
{

    private $package;
    private $status = StatusEnum::OK;

    public function getPackage(): PackageEntity
    {
        return $this->package;
    }

    public function setPackage(PackageEntity $package): void
    {
        $this->package = $package;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }
}
