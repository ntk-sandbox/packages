<?php

namespace Untek\Framework\Rpc\Domain\Base;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Untek\Bundle\Language\Domain\Interfaces\Services\RuntimeLanguageServiceInterface;
use Untek\Core\App\Subscribers\PhpErrorSubscriber;
use Untek\Core\Container\Interfaces\ContainerConfiguratorInterface;
use Untek\Core\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use Untek\Framework\Rpc\Domain\Subscribers\ApplicationAuthenticationSubscriber;
use Untek\Framework\Rpc\Domain\Subscribers\Authentication\RpcAuthenticationFromAllSubscriber;
use Untek\Framework\Rpc\Domain\Subscribers\Authentication\RpcAuthenticationFromChainSubscriber;
use Untek\Framework\Rpc\Domain\Subscribers\CheckAccessSubscriber;
use Untek\Framework\Rpc\Domain\Subscribers\CryptoProviderSubscriber;
use Untek\Framework\Rpc\Domain\Subscribers\LanguageSubscriber;
use Untek\Framework\Rpc\Domain\Subscribers\LogSubscriber;
use Untek\Framework\Rpc\Domain\Subscribers\TimestampSubscriber;
use Untek\Framework\Rpc\Symfony4\HttpKernel\RpcKernel;
use Untek\Core\App\Base\BaseApp;
use Untek\Component\Web\WebApp\Subscribers\WebDetectTestEnvSubscriber;

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
            PhpErrorSubscriber::class,
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
//        $configurator->addSubscriber(RpcAuthenticationFromAllSubscriber::class); // Аутентификация пользователя
        $configurator->addSubscriber(RpcAuthenticationFromChainSubscriber::class); // Аутентификация пользователя
        $configurator->addSubscriber(CheckAccessSubscriber::class); // Проверка прав доступа
//        $configurator->addSubscriber(TimestampSubscriber::class); // Проверка метки времени запроса и подстановка метки времени ответа
//        $configurator->addSubscriber(CryptoProviderSubscriber::class); // Проверка подписи запроса и подписание ответа
//        $configurator->addSubscriber(LogSubscriber::class); // Логирование запроса и ответа

        if ($this->getContainer()->has(RuntimeLanguageServiceInterface::class)) {
            $configurator->addSubscriber(LanguageSubscriber::class); // Обработка языка
        }
    }
}
