<?php

namespace ZnFramework\Rpc\Domain\Interfaces\Services;

use ZnFramework\Rpc\Domain\Entities\SettingsEntity;

interface SettingsServiceInterface
{

    public function update(SettingsEntity $settingsEntity);
    public function view(): SettingsEntity;
}

