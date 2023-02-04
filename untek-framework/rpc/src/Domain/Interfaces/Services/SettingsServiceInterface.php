<?php

namespace Untek\Framework\Rpc\Domain\Interfaces\Services;

use Untek\Framework\Rpc\Domain\Entities\SettingsEntity;

interface SettingsServiceInterface
{

    public function update(SettingsEntity $settingsEntity);
    public function view(): SettingsEntity;
}

