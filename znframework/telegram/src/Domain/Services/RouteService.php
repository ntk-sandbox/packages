<?php

namespace ZnFramework\Telegram\Domain\Services;

use danog\MadelineProto\APIFactory;
use ZnCore\Container\Helpers\ContainerHelper;
use ZnCore\Instance\Libs\InstanceProvider;
use ZnFramework\Telegram\Domain\Base\BaseAction;
use ZnFramework\Telegram\Domain\Entities\RequestEntity;
use ZnFramework\Telegram\Domain\Interfaces\MatcherInterface;
use ZnFramework\Telegram\Domain\Services\SessionService;
use ZnFramework\Telegram\Domain\Services\StateService;
use ZnFramework\Telegram\Domain\Services\UserService;

class RouteService
{

    private $_definitions;

    public function definitions(): array
    {

    }

    public function onUpdateNewMessage(RequestEntity $requestEntity)
    {
        $this->handleMessage($requestEntity);
    }

    public function setDefinitions(array $definitions)
    {
        $this->_definitions = $definitions;
    }

    /**
     * @param $requestEntity
     * @return mixed
     */
    private function handleMessage(RequestEntity $requestEntity)
    {
        $definitions = $this->getDefinitions();
        foreach ($definitions as $item) {
            //$isActive = empty($item['state']) || ($item['state'] == '*' && !empty($action)) || ($item['state'] == $action);
            $isActive = 1;
            if ($isActive) {
                /** @var InstanceProvider $instanceProvider */
                $instanceProvider = ContainerHelper::getContainer()->get(InstanceProvider::class);

                /** @var MatcherInterface $matcherInstance */
                $matcherInstance = $instanceProvider->createInstance($item['matcher']);
                /** @var BaseAction $actionInstance */
                $actionInstance = $instanceProvider->createInstance($item['action']);

                if ($matcherInstance->isMatch($requestEntity)) {
                    //$this->humanizeResponseDelay($requestEntity);
                    $actionInstance->run($requestEntity);
                }
            }
        }
        return null;
    }

    private function getDefinitions()
    {
        if (empty($this->_definitions)) {
            $this->_definitions = $this->definitions();
        }
        return $this->_definitions;
    }

    private function prepareResponse(APIFactory $messages)
    {
        $container = ContainerHelper::getContainer();
        /** @var ResponseService $response */
        $response = $container->get(ResponseService::class);
        $response->setApi($messages);
    }

    private function auth($update)
    {
        $container = ContainerHelper::getContainer();
        /** @var UserService $userService */
        $userService = $container->get(UserService::class);
        $userService->authByUpdate($update);
    }

    private function getStateFromSession()
    {
        $container = ContainerHelper::getContainer();
        /** @var StateService $state */
        $state = $container->get(StateService::class);
        return $state->get();
    }

    private function humanizeResponseDelay($update)
    {
        if (getenv('APP_ENV') == 'prod') {
            $seconds = mt_rand(getenv('HUMANIZE_RESPONSE_DELAY_MIN') ?: 1, getenv('HUMANIZE_RESPONSE_DELAY_MAX') ?: 4);
            sleep($seconds);
        }
    }
}