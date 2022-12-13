<?php

namespace ZnFramework\Telegram\Domain\Base;

use ZnCore\Container\Libs\Container;
use ZnCore\Container\Helpers\ContainerHelper;
use ZnFramework\Telegram\Domain\Entities\RequestEntity;
use ZnFramework\Telegram\Domain\Services\ResponseService;
use ZnFramework\Telegram\Domain\Services\SessionService;
use ZnFramework\Telegram\Domain\Services\StateService;
use ZnFramework\Telegram\Domain\Services\UserService;

abstract class BaseAction
{

    /** @var SessionService */
    protected $session;

    /** @var StateService */
    protected $state;

    /** @var ResponseService */
    protected $response;

    public function __construct()
    {
        $container = ContainerHelper::getContainer();
        //$this->session = $container->get(SessionService::class);
        //$this->state = $container->get(StateService::class);
        /** @var ResponseService $response */
        $this->response = $container->get(ResponseService::class);
        //$this->response = new ResponseService($messages, $container->get(UserService::class));
    }

    public function stateName()
    {
        return null;
    }

    abstract public function run(RequestEntity $requestEntity);

}
