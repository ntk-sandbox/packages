<?php

namespace Untek\Framework\Rpc\Domain\Services;

use Untek\Core\Instance\Helpers\PropertyHelper;
use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\Domain\Validator\Helpers\ValidationHelper;
use Untek\Framework\Rpc\Domain\Entities\SettingsEntity;
use Untek\Framework\Rpc\Domain\Interfaces\Services\SettingsServiceInterface;
use Untek\Sandbox\Sandbox\Settings\Domain\Interfaces\Services\SystemServiceInterface;

class SettingsService implements SettingsServiceInterface
{

    private $systemService;

    public function __construct(SystemServiceInterface $systemService)
    {
        $this->systemService = $systemService;
    }

    public function getEntityClass(): string
    {
        return SettingsEntity::class;
    }

    public function update(SettingsEntity $settingsEntity)
    {
        ValidationHelper::validateEntity($settingsEntity);
        $settingsData = EntityHelper::toArray($settingsEntity);
        $this->systemService->update('rpc', $settingsData);
    }

    public function view(): SettingsEntity
    {
        $data = $this->systemService->view('rpc');
        $settingsEntity = new SettingsEntity();
        PropertyHelper::setAttributes($settingsEntity, $data);
        return $settingsEntity;
    }
}
