<?php

return [
    'definitions' => [],
    'singletons' => [
        \Untek\Tool\Dev\Composer\Domain\Interfaces\Repositories\ConfigRepositoryInterface::class => \Untek\Tool\Dev\Composer\Domain\Repositories\File\ConfigRepository::class,
        \Untek\Tool\Dev\Composer\Domain\Interfaces\Services\ConfigServiceInterface::class => \Untek\Tool\Dev\Composer\Domain\Services\ConfigService::class,
        \Untek\Tool\Package\Domain\Interfaces\Services\GitServiceInterface::class => \Untek\Tool\Package\Domain\Services\GitService::class,
        \Untek\Tool\Package\Domain\Interfaces\Services\PackageServiceInterface::class => \Untek\Tool\Package\Domain\Services\PackageService::class,
        \Untek\Tool\Package\Domain\Repositories\File\GroupRepository::class => function (\Psr\Container\ContainerInterface $container) {
            /** @var \Untek\Core\App\Interfaces\EnvStorageInterface $envStorage */
            $envStorage = $container->get(\Untek\Core\App\Interfaces\EnvStorageInterface::class);

            $fileName = $envStorage->get('PACKAGE_GROUP_CONFIG') ? $envStorage->get('PACKAGE_GROUP_CONFIG') : __DIR__ . '/../../../src/Domain/Data/package_group.php';
            $repo = new \Untek\Tool\Package\Domain\Repositories\File\GroupRepository($fileName);
            return $repo;
        },
        \Untek\Tool\Package\Domain\Interfaces\Repositories\PackageRepositoryInterface::class => \Untek\Tool\Package\Domain\Repositories\File\PackageRepository::class,
        \Untek\Tool\Package\Domain\Interfaces\Repositories\GitRepositoryInterface::class => \Untek\Tool\Package\Domain\Repositories\File\GitRepository::class,
    ],
];
