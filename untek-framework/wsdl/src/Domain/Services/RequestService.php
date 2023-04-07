<?php

namespace Untek\Framework\Wsdl\Domain\Services;

use Untek\Framework\Wsdl\Domain\Entities\TransportEntity;
use Untek\Framework\Wsdl\Domain\Enums\DirectionEnum;
use Untek\Framework\Wsdl\Domain\Enums\StatusEnum;
use Untek\Framework\Wsdl\Domain\Interfaces\Services\RequestServiceInterface;
use Untek\Framework\Wsdl\Domain\Libs\SoapHandler;
use Psr\Container\ContainerInterface;
use Untek\Core\Container\Traits\ContainerAwareTrait;
use Untek\Core\FileSystem\Helpers\FileStorageHelper;
use Untek\Model\Service\Base\BaseService;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;

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
