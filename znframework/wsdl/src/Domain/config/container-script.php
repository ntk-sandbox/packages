<?php

use ZnFramework\Wsdl\Domain\Interfaces\Repositories\ClientRepositoryInterface;
use ZnFramework\Wsdl\Domain\Libs\SoapHandler;
use Psr\Container\ContainerInterface;


use ZnCore\Env\Helpers\EnvHelper;
use ZnCore\Container\Interfaces\ContainerConfiguratorInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerConfiguratorInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;

return function (ContainerConfiguratorInterface $configurator) {
    $configurator->importFromDir([__DIR__ . '/../src']);
    $isNullDriver = EnvHelper::isTest() || EnvHelper::isDev();
    if($isNullDriver) {
        $configurator->singleton(ClientRepositoryInterface::class, 'ZnFramework\\Wsdl\\Domain\\Repositories\\Null\\ClientRepository');
    } else {
        $configurator->singleton(ClientRepositoryInterface::class, 'ZnFramework\\Wsdl\\Domain\\Repositories\\Wsdl\\ClientRepository');
    }

//    $configurator->singleton(SoapHandler::class, function(ContainerInterface $container) {
//        /** @var SoapHandler $soapHandler */
//        $soapHandler = new SoapHandler($container);
//        $soapHandler->setDefinitionFile(__DIR__ . '/../../../Message/Wsdl/config/wsdl/AsyncChannel/v10/Interfaces/AsyncChannelHttp_Service.wsdl');
//        $soapHandler->addService(SendMessageController::class);
//        return $soapHandler;
//    });

//    $em->bindEntity('', '');
};







//return [
//	'singletons' => [
//        'ZnFramework\\Wsdl\\Domain\\Interfaces\\Repositories\\ClientRepositoryInterface' => EnvHelper::isTest()
//            ? 'ZnFramework\\Wsdl\\Domain\\Repositories\\Null\\ClientRepository'
//            : 'ZnFramework\\Wsdl\\Domain\\Repositories\\Wsdl\\ClientRepository'
//        ,
//		SoapHandler::class => function(ContainerInterface $container) {
//            /** @var SoapHandler $soapHandler */
//            $soapHandler = new SoapHandler($container);
//            $soapHandler->setDefinitionFile(__DIR__ . '/../../../Message/Wsdl/config/wsdl/AsyncChannel/v10/Interfaces/AsyncChannelHttp_Service.wsdl');
//            $soapHandler->addService(SendMessageController::class);
//            return $soapHandler;
//        },
//	],
//];
