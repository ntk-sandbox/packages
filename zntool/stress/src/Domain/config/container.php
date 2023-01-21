<?php

use Symfony\Component\Console\Application;
use ZnCore\Contract\Common\Exceptions\InvalidConfigException;
use ZnCore\DotEnv\Domain\Libs\DotEnv;
use ZnCore\Container\Libs\Container;
use ZnDatabase\Eloquent\Domain\Factories\ManagerFactory;
use ZnDatabase\Eloquent\Domain\Capsule\Manager;
use ZnTool\Stress\Domain\Repositories\Conf\ProfileRepository;

return [
    'definitions' => [],
    'singletons' => [
        Application::class => Application::class,
        /*Manager::class => function () {
            return ManagerFactory::createManagerFromEnv();
        },*/
        ProfileRepository::class => function (\Psr\Container\ContainerInterface $container) {
            /** @var \ZnCore\App\Interfaces\EnvStorageInterface $envStorage */
            $envStorage = $container->get(\ZnCore\App\Interfaces\EnvStorageInterface::class);

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
