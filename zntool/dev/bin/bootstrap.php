<?php


use ZnCore\Container\Interfaces\ContainerConfiguratorInterface;
use ZnCore\Container\Libs\Container;
use Symfony\Component\Console\Application;
use ZnCore\Container\Helpers\ContainerHelper;
use ZnFramework\Console\Symfony4\Helpers\CommandHelper;

/**
 * @var Application $application
 * @var Container $container
 */

\ZnCore\Code\Helpers\DeprecateHelper::hardThrow();

//$container = Container::getInstance();

// --- Application ---

//$container->bind(Application::class, Application::class, true);

// --- Generator ---

/** @var ContainerConfiguratorInterface $containerConfigurator */
$containerConfigurator = $container->get(ContainerConfiguratorInterface::class);
//$containerConfigurator = ContainerHelper::getContainerConfiguratorByContainer($container);

$containerConfigurator->bind(\ZnTool\Generator\Domain\Interfaces\Services\DomainServiceInterface::class, \ZnTool\Generator\Domain\Services\DomainService::class);
$containerConfigurator->bind(\ZnTool\Generator\Domain\Interfaces\Services\ModuleServiceInterface::class, \ZnTool\Generator\Domain\Services\ModuleService::class);

// --- Composer ---


$containerConfigurator->bind(\ZnTool\Dev\Composer\Domain\Interfaces\Repositories\ConfigRepositoryInterface::class, \ZnTool\Dev\Composer\Domain\Repositories\File\ConfigRepository::class);
$containerConfigurator->bind(\ZnTool\Dev\Composer\Domain\Interfaces\Services\ConfigServiceInterface::class, \ZnTool\Dev\Composer\Domain\Services\ConfigService::class);

// --- Package ---

$containerConfigurator->bind(\ZnTool\Package\Domain\Interfaces\Services\GitServiceInterface::class, \ZnTool\Package\Domain\Services\GitService::class);
$containerConfigurator->bind(\ZnTool\Package\Domain\Interfaces\Services\PackageServiceInterface::class, \ZnTool\Package\Domain\Services\PackageService::class);
$containerConfigurator->bind(\ZnTool\Package\Domain\Repositories\File\GroupRepository::class, function () {
    $fileName = ! empty($_ENV['PACKAGE_GROUP_CONFIG']) ? $_ENV['PACKAGE_GROUP_CONFIG'] : __DIR__ . '/../src/Package/Domain/Data/package_group.php';
    $repo = new \ZnTool\Package\Domain\Repositories\File\GroupRepository($fileName);
    return $repo;
});
$containerConfigurator->bind(\ZnTool\Package\Domain\Interfaces\Repositories\PackageRepositoryInterface::class, \ZnTool\Package\Domain\Repositories\File\PackageRepository::class);
$containerConfigurator->bind(\ZnTool\Package\Domain\Interfaces\Repositories\GitRepositoryInterface::class, \ZnTool\Package\Domain\Repositories\File\GitRepository::class);

CommandHelper::registerFromNamespaceList([
    'ZnTool\Generator\Commands',
    'ZnTool\Package\Commands',
    'ZnTool\Dev\Composer\Commands',
], $container);
