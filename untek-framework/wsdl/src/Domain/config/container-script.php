<?php

use Untek\Framework\Wsdl\Domain\Interfaces\Repositories\ClientRepositoryInterface;
use Untek\Framework\Wsdl\Domain\Libs\SoapHandler;
use Psr\Container\ContainerInterface;


use Untek\Core\Env\Helpers\EnvHelper;
use Untek\Core\Container\Interfaces\ContainerConfiguratorInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerConfiguratorInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;

return function (ContainerConfiguratorInterface $configurator) {
    $configurator->importFromDir([__DIR__ . '/../src']);
    $isNullDriver = EnvHelper::isTest() || EnvHelper::isDev();
    if($isNullDriver) {
        $configurator->singleton(ClientRepositoryInterface::class, 'Untek\\Framework\\Wsdl\\Domain\\Repositories\\Null\\ClientRepository');
    } else {
        $configurator->singleton(ClientRepositoryInterface::class, 'Untek\\Framework\\Wsdl\\Domain\\Repositories\\Wsdl\\ClientRepository');
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
//        'Untek\\Framework\\Wsdl\\Domain\\Interfaces\\Repositories\\ClientRepositoryInterface' => EnvHelper::isTest()
//            ? 'Untek\\Framework\\Wsdl\\Domain\\Repositories\\Null\\ClientRepository'
//            : 'Untek\\Framework\\Wsdl\\Domain\\Repositories\\Wsdl\\ClientRepository'
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
