<?php

use Symfony\Component\Console\Application;
use Untek\Core\Contract\Common\Exceptions\InvalidConfigException;
use Untek\Core\DotEnv\Domain\Libs\DotEnv;
use Untek\Core\Container\Libs\Container;
use Untek\Database\Eloquent\Domain\Factories\ManagerFactory;
use Untek\Database\Eloquent\Domain\Capsule\Manager;
use Untek\Tool\Stress\Domain\Repositories\Conf\ProfileRepository;

return [
    'definitions' => [],
    'singletons' => [
        Application::class => Application::class,
        /*Manager::class => function () {
            return ManagerFactory::createManagerFromEnv();
        },*/
        ProfileRepository::class => function (\Psr\Container\ContainerInterface $container) {
            /** @var \Untek\Core\App\Interfaces\EnvStorageInterface $envStorage */
            $envStorage = $container->get(\Untek\Core\App\Interfaces\EnvStorageInterface::class);

            $config = [];
            /*if(!$envStorage->has('STRESS_PROFILE_CONFIG')) {
                throw new InvalidConfigException('Empty ENV "STRESS_PROFILE_CONFIG"!');
            }*/
            if($envStorage->get('STRESS_PROFILE_CONFIG')) {
                $configFileName = $envStorage->get('STRESS_PROFILE_CONFIG');
                $config = include ($configFileName);
            }
            return new ProfileRepository($config);
        },
    ],
];
