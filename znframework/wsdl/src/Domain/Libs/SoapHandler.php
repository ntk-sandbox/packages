<?php

namespace ZnFramework\Wsdl\Domain\Libs;

use Psr\Container\ContainerInterface;
use SoapServer;
use ZnCore\Container\Traits\ContainerAwareTrait;

class SoapHandler
{

    use ContainerAwareTrait;

    private $services = [];
    private $definitionFile;

    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    public function getDefinitionFile(): string
    {
        return $this->definitionFile;
    }

    public function setDefinitionFile(string $definitionFile): void
    {
        $this->definitionFile = $definitionFile;
    }

    public function addService($serviceDefinition): void
    {
        $this->services[] = $serviceDefinition;
    }

    public function call(string $requestXml): string
    {
        $soapServer = $this->createSoapServer();
        return $this->handleRequest($requestXml, $soapServer);
    }

    private function createSoapServer(): SoapServer
    {
        $soapServer = new SoapServer($this->getDefinitionFile());
        foreach ($this->services as $serviceDefinition) {
            $serviceInstance = $this->getServiceInstance($serviceDefinition);
            $soapServer->setObject($serviceInstance);
        }
        return $soapServer;
    }

    private function getServiceInstance($serviceDefinition): object
    {
        if (is_object($serviceDefinition)) {
            $serviceInstance = $serviceDefinition;
        } else {
            $serviceInstance = $this->getContainer()->get($serviceDefinition);
//            $serviceInstance = DiHelper::make($serviceDefinition, $this->getContainer());
        }
        return $serviceInstance;
    }

    private function handleRequest(string $requestXml, SoapServer $soapServer): string
    {
        ob_start();
        $soapServer->handle($requestXml);
        return ob_get_clean();
    }
}
