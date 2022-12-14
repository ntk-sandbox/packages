<?php

use ZnCore\Container\Interfaces\ContainerConfiguratorInterface;
use ZnCore\Container\Libs\Container;
use Symfony\Component\Console\Application;
use ZnCore\Container\Helpers\ContainerHelper;
use ZnCore\FileSystem\Helpers\FilePathHelper;
use ZnFramework\Console\Symfony4\Helpers\CommandHelper;
use ZnCrypt\Pki\Domain\Libs\Rsa\RsaStoreFile;
use ZnLib\Components\Time\Enums\TimeEnum;
use Symfony\Component\Cache\Adapter\AbstractAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Request;
use ZnLib\Rest\Symfony4\Helpers\RestApiControllerHelper;
use ZnCore\FileSystem\Helpers\FileHelper;

/**
 * @var Application $application
 * @var Container $container
 */

// --- Generator ---

/** @var ContainerConfiguratorInterface $containerConfigurator */
$containerConfigurator = $container->get(ContainerConfiguratorInterface::class);
//$containerConfigurator = ContainerHelper::getContainerConfiguratorByContainer($container);
$containerConfigurator->bind(RsaStoreFile::class, function () {
    $rsaDirectory = $_ENV['RSA_CA_DIRECTORY'];
    return new RsaStoreFile($rsaDirectory);
}, true);
$containerConfigurator->bind(AbstractAdapter::class, function () {
    $cacheDirectory = $_ENV['CACHE_DIRECTORY'];
    return new FilesystemAdapter('cryptoSession', TimeEnum::SECOND_PER_DAY, $cacheDirectory);
}, true);

/*$container->bind(RsaStoreFile::class, function () {
    $rsaDirectory = FileHelper::rootPath() . '/' . $_ENV['RSA_CA_DIRECTORY'];
    return new RsaStoreFile($rsaDirectory);
}, true);
$container->bind(AbstractAdapter::class, function () {
    $cacheDirectory = FileHelper::rootPath() . '/' . $_ENV['CACHE_DIRECTORY'];
    return new FilesystemAdapter('cryptoSession', TimeEnum::SECOND_PER_DAY, $cacheDirectory);
}, true);*/

CommandHelper::registerFromNamespaceList([
    'ZnCrypt\Pki\Symfony4\Commands',
], $container);
