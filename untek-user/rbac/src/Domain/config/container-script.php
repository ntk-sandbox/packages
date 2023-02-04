<?php

use Psr\Container\ContainerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Untek\User\Rbac\Domain\Services\AuthorizationCheckerService;

$isDbDriver = true;
//$isDbDriver = !EnvHelper::isDev();

return [
    'singletons' => [
        AuthorizationCheckerInterface::class => AuthorizationCheckerService::class,
        'security.authorization_checker' => AuthorizationCheckerInterface::class,
        'Untek\\User\\Rbac\\Domain\\Interfaces\\Repositories\\RoleRepositoryInterface' => $isDbDriver
            ? 'Untek\\User\\Rbac\\Domain\\Repositories\\Eloquent\\RoleRepository'
            : function (ContainerInterface $container) {
                /** @var \Untek\Core\App\Interfaces\EnvStorageInterface $envStorage */
                $envStorage = $container->get(\Untek\Core\App\Interfaces\EnvStorageInterface::class);

                $fileName = $envStorage->get('FIXTURE_DIRECTORY') ? $envStorage->get('FIXTURE_DIRECTORY') . '/rbac_item.php' : __DIR__ . '/../../../../../../fixtures/rbac_item.php';
                $repository = $container->get('Untek\\User\\Rbac\\Domain\\Repositories\\File\\RoleRepository');
                $repository->setFileName($fileName);
            },
        'Untek\\User\\Rbac\\Domain\\Interfaces\\Repositories\\InheritanceRepositoryInterface' => $isDbDriver
            ? 'Untek\\User\\Rbac\\Domain\\Repositories\\Eloquent\\InheritanceRepository'
            : function (ContainerInterface $container) {
                /** @var \Untek\Core\App\Interfaces\EnvStorageInterface $envStorage */
                $envStorage = $container->get(\Untek\Core\App\Interfaces\EnvStorageInterface::class);

                $fileName = $envStorage->get('FIXTURE_DIRECTORY') ? $envStorage->get('FIXTURE_DIRECTORY') . '/rbac_inheritance.php' : __DIR__ . '/../../../../../../fixtures/rbac_inheritance.php';
                $repository = $container->get('Untek\\User\\Rbac\\Domain\\Repositories\\File\\InheritanceRepository');
                $repository->setFileName($fileName);
                return $repository;
            },
        'Untek\\User\\Rbac\\Domain\\Interfaces\\Repositories\\ItemRepositoryInterface' => $isDbDriver
            ? 'Untek\\User\\Rbac\\Domain\\Repositories\\Eloquent\\ItemRepository'
            : function (ContainerInterface $container) {
                /** @var \Untek\Core\App\Interfaces\EnvStorageInterface $envStorage */
                $envStorage = $container->get(\Untek\Core\App\Interfaces\EnvStorageInterface::class);

                $fileName = $envStorage->get('FIXTURE_DIRECTORY') ? $envStorage->get('FIXTURE_DIRECTORY') . '/rbac_item.php' : __DIR__ . '/../../../../../../fixtures/rbac_item.php';
                $repository = $container->get('Untek\\User\\Rbac\\Domain\\Repositories\\File\\ItemRepository');
                $repository->setFileName($fileName);
            },
        'Untek\\User\\Rbac\\Domain\\Interfaces\\Repositories\\PermissionRepositoryInterface' => $isDbDriver
            ? 'Untek\\User\\Rbac\\Domain\\Repositories\\Eloquent\\PermissionRepository'
            : function (ContainerInterface $container) {
                /** @var \Untek\Core\App\Interfaces\EnvStorageInterface $envStorage */
                $envStorage = $container->get(\Untek\Core\App\Interfaces\EnvStorageInterface::class);

                $fileName = $envStorage->get('FIXTURE_DIRECTORY') ? $envStorage->get('FIXTURE_DIRECTORY') . '/rbac_item.php' : __DIR__ . '/../../../../../../fixtures/rbac_item.php';
                $repository = $container->get('Untek\\User\\Rbac\\Domain\\Repositories\\File\\PermissionRepository');
                $repository->setFileName($fileName);
            },

//        ManagerServiceInterface::class => function(ContainerInterface $container) {
//            /** @var ManagerService $managerService */
//            $managerService = $container->make(ManagerService::class);
//            $managerService->setDefaultRoles([SystemRoleEnum::GUEST]);
//            return $managerService;
//        },
    ],
];