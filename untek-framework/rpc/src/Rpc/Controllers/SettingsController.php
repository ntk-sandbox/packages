<?php

namespace Untek\Framework\Rpc\Rpc\Controllers;

use Untek\Core\Instance\Helpers\PropertyHelper;
use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Framework\Rpc\Domain\Interfaces\Services\SettingsServiceInterface;

class SettingsController
{

    private $service;

    public function __construct(SettingsServiceInterface $systemService)
    {
        $this->service = $systemService;
    }

    public function update(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $body = $requestEntity->getParams();
        $settingsEntity = $this->service->view();
        PropertyHelper::setAttributes($settingsEntity, $body);
        $this->service->update($settingsEntity);
        return new RpcResponseEntity();
    }

    public function view(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $settingsEntity = $this->service->view();
        return new RpcResponseEntity(EntityHelper::toArray($settingsEntity));
    }
}
