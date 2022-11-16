<?php

namespace ZnFramework\Rpc\Rpc\Controllers;

use ZnCore\Code\Helpers\PropertyHelper;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Domain\Interfaces\Services\SettingsServiceInterface;

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
