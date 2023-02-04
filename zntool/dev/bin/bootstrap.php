<?php


use Untek\Core\Container\Interfaces\ContainerConfiguratorInterface;
use Untek\Core\Container\Libs\Container;
use Symfony\Component\Console\Application;
use Untek\Core\Container\Helpers\ContainerHelper;
use Untek\Framework\Console\Symfony4\Helpers\CommandHelper;

/**
 * @var Application $application
 * @var Container $container
 */

\Untek\Core\Code\Helpers\DeprecateHelper::hardThrow();

//$container = Container::getInstance();

// --- Application ---

//$container->bind(Application::class, Application::class, true);

// --- Generator ---

/** @var ContainerConfiguratorInterface $containerConfigurator */
$containerConfigurator = $container->get(ContainerConfiguratorInterface::class);
//$containerConfigurator = ContainerHelper::getContainerConfiguratorByContainer($container);

$containerConfigurator->bind(\Untek\Tool\Generator\Domain\Interfaces\Services\DomainServiceInterface::class, \Untek\Tool\Generator\Domain\Services\DomainService::class);
$containerConfigurator->bind(\Untek\Tool\Generator\Domain\Interfaces\Services\ModuleServiceInterface::class, \Untek\Tool\Generator\Domain\Services\ModuleService::class);

// --- Composer ---


$containerConfigurator->bind(\Untek\Tool\Dev\Composer\Domain\Interfaces\Repositories\ConfigRepositoryInterface::class, \Untek\Tool\Dev\Composer\Domain\Repositories\File\ConfigRepository::class);
$containerConfigurator->bind(\Untek\Tool\Dev\Composer\Domain\Interfaces\Services\ConfigServiceInterface::class, \Untek\Tool\Dev\Composer\Domain\Services\ConfigService::class);

// --- Package ---

$containerConfigurator->bind(\Untek\Tool\Package\Domain\Interfaces\Services\GitServiceInterface::class, \Untek\Tool\Package\Domain\Services\GitService::class);
$containerConfigurator->bind(\Untek\Tool\Package\Domain\Interfaces\Services\PackageServiceInterface::class, \Untek\Tool\Package\Domain\Services\PackageService::class);
$containerConfigurator->bind(\Untek\Tool\Package\Domain\Repositories\File\GroupRepository::class, function () {
    $fileName = getenv('PACKAGE_GROUP_CONFIG') ? getenv('PACKAGE_GROUP_CONFIG') : __DIR__ . '/../src/Package/Domain/Data/package_group.php';
    $repo = new \Untek\Tool\Package\Domain\Repositories\File\GroupRepository($fileName);
    return $repo;
});
$containerConfigurator->bind(\Untek\Tool\Package\Domain\Interfaces\Repositories\PackageRepositoryInterface::class, \Untek\Tool\Package\Domain\Repositories\File\PackageRepository::class);
$containerConfigurator->bind(\Untek\Tool\Package\Domain\Interfaces\Repositories\GitRepositoryInterface::class, \Untek\Tool\Package\Domain\Repositories\File\GitRepository::class);

CommandHelper::registerFromNamespaceList([
    'Untek\Tool\Generator\Commands',
    'Untek\Tool\Package\Commands',
    'Untek\Tool\Dev\Composer\Commands',
], $container);
