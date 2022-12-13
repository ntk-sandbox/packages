<?php

namespace ZnFramework\Wsdl\Domain\Services;

use ZnFramework\Wsdl\Domain\Entities\TransportEntity;
use ZnFramework\Wsdl\Domain\Enums\DirectionEnum;
use ZnFramework\Wsdl\Domain\Enums\StatusEnum;
use ZnFramework\Wsdl\Domain\Interfaces\Services\RequestServiceInterface;
use ZnFramework\Wsdl\Domain\Libs\SoapHandler;
use Psr\Container\ContainerInterface;
use ZnCore\Container\Traits\ContainerAwareTrait;
use ZnCore\FileSystem\Helpers\FileStorageHelper;
use ZnDomain\Service\Base\BaseService;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;

class RequestService extends BaseService implements RequestServiceInterface
{

    use ContainerAwareTrait;

    private $soapHandler;
    private $transportEntity;

    public function __construct(ContainerInterface $container, EntityManagerInterface $em, SoapHandler $soapHandler)
    {
        $this->setEntityManager($em);
        $this->setContainer($container);
        $this->soapHandler = $soapHandler;
    }

    public function getEntityClass(): string
    {
        return '';//RequestEntity::class;
    }

    public function getTransportEntity(): TransportEntity
    {
        return $this->transportEntity;
    }

    public function addRequest(string $requestXml): void
    {
        $transportEntity = new TransportEntity();
        $transportEntity->setRequest($requestXml);
        $transportEntity->setDirection(DirectionEnum::IN);
        $this->getEntityManager()->insert($transportEntity);
    }

    public function runRequest(string $requestXml): string
    {
        $transportEntity = new TransportEntity();
        $transportEntity->setRequest($requestXml);
        $transportEntity->setDirection(DirectionEnum::IN);
        $transportEntity->setStatusId(StatusEnum::COMPLETE);
        $this->getEntityManager()->insert($transportEntity);

        $this->transportEntity = $transportEntity;

        $responseXml = $this->soapHandler->call($requestXml);
        $transportEntity->setResponse($responseXml);

        $this->getEntityManager()->persist($transportEntity);

        return $responseXml;
    }

    public function runQueue(): void
    {
        $collection = $this
            ->getEntityManager()
            ->getRepository(TransportEntity::class)
            ->allByNewStatus();

        /** @var TransportEntity $transportEntity */
        foreach ($collection as $transportEntity) {
            $responseXml = $this->runQueueItem($transportEntity);
//            dd($responseXml);
//            $transportEntity->setResponse($responseXml);
        }
    }

    public function runQueueItem(TransportEntity $transportEntity): ?string
    {
        $requestXml = $transportEntity->getData();
        $responseXml = $this->soapHandler->call($requestXml);
//        $this->addResponse($transportEntity->getId(), $responseXml);

//        $transportEntity->setData($responseXml);
        $transportEntity->setStatusId(StatusEnum::COMPLETE);

        $this->getEntityManager()->update($transportEntity);
        return $responseXml;
    }

    private function addResponse(int $transportId, string $responseXml)
    {
        $transportEntity = new TransportEntity();
        $transportEntity->setParentId($transportId);
        $transportEntity->setResponse($responseXml);
        $transportEntity->setDirection(DirectionEnum::OUT);
        $this->getEntityManager()->insert($transportEntity);
    }

    public function getWsdlDefinition()
    {
        return FileStorageHelper::load($this->soapHandler->getDefinitionFile());
    }
}
