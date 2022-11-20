<?php

namespace ZnFramework\Rpc\Domain\Base;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use ZnBundle\Language\Domain\Interfaces\Services\RuntimeLanguageServiceInterface;
use ZnCore\Container\Interfaces\ContainerConfiguratorInterface;
use ZnCore\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use ZnFramework\Rpc\Domain\Subscribers\ApplicationAuthenticationSubscriber;
use ZnFramework\Rpc\Domain\Subscribers\Authentication\RpcAuthenticationFromAllSubscriber;
use ZnFramework\Rpc\Domain\Subscribers\CheckAccessSubscriber;
use ZnFramework\Rpc\Domain\Subscribers\CryptoProviderSubscriber;
use ZnFramework\Rpc\Domain\Subscribers\LanguageSubscriber;
use ZnFramework\Rpc\Domain\Subscribers\LogSubscriber;
use ZnFramework\Rpc\Domain\Subscribers\RpcFirewallSubscriber;
use ZnFramework\Rpc\Domain\Subscribers\TimestampSubscriber;
use ZnFramework\Rpc\Symfony4\HttpKernel\RpcKernel;
use ZnCore\App\Base\BaseApp;
use ZnLib\Web\WebApp\Subscribers\WebDetectTestEnvSubscriber;

abstract class BaseRpcApp extends BaseApp
{

    public function appName(): string
    {
        return 'rpc';
    }

    public function subscribes(): array
    {
        return [
            WebDetectTestEnvSubscriber::class,
        ];
    }

    public function import(): array
    {
        return ['i18next', 'container', 'entityManager', 'eventDispatcher', 'rbac', 'symfonyRpc'];
    }

    protected function configContainer(ContainerConfiguratorInterface $containerConfigurator): void
    {
        $containerConfigurator->singleton(HttpKernelInterface::class, RpcKernel::class);
    }

    protected function configDispatcher(EventDispatcherConfiguratorInterface $configurator): void
    {
        //        $configurator->addSubscriber(ApplicationAuthenticationSubscriber::class); // Аутентификация приложения
//        $configurator->addSubscriber(RpcAuthenticationFromMetaSubscriber::class); // Аутентификация пользователя
//        $configurator->addSubscriber(RpcAuthenticationFromHeaderSubscriber::class); // Аутентификация пользователя
        $configurator->addSubscriber(RpcAuthenticationFromAllSubscriber::class); // Аутентификация пользователя
//        $configurator->addSubscriber(RpcFirewallSubscriber::class); // Аутентификация пользователя

        $configurator->addSubscriber(CheckAccessSubscriber::class); // Проверка прав доступа
//        $configurator->addSubscriber(TimestampSubscriber::class); // Проверка метки времени запроса и подстановка метки времени ответа
//        $configurator->addSubscriber(CryptoProviderSubscriber::class); // Проверка подписи запроса и подписание ответа
//        $configurator->addSubscriber(LogSubscriber::class); // Логирование запроса и ответа

        if($this->getContainer()->has(RuntimeLanguageServiceInterface::class)) {
            $configurator->addSubscriber(LanguageSubscriber::class); // Обработка языка
        }
    }
}
