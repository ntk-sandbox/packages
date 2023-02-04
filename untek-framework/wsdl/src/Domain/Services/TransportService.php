<?php

namespace Untek\Framework\Wsdl\Domain\Services;

use Untek\Framework\Wsdl\Domain\Entities\TransportEntity;
use Untek\Framework\Wsdl\Domain\Enums\StatusEnum;
use Untek\Framework\Wsdl\Domain\Interfaces\Repositories\ClientRepositoryInterface;
use Untek\Framework\Wsdl\Domain\Interfaces\Repositories\TransportRepositoryInterface;
use Untek\Framework\Wsdl\Domain\Interfaces\Services\TransportServiceInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;

/**
 * @method TransportRepositoryInterface getRepository()
 */
class TransportService extends BaseCrudService implements TransportServiceInterface
{

    private $sendMessageRepository;

    public function __construct(
        EntityManagerInterface $em,
        ClientRepositoryInterface $sendMessageRepository
    )
    {
        $this->setEntityManager($em);
        $this->sendMessageRepository = $sendMessageRepository;
    }

    public function getEntityClass(): string
    {
        return TransportEntity::class;
    }

    public function sendAll(): void
    {
        $collection = $this
            ->getEntityManager()
            ->getRepository(TransportEntity::class)
            ->allByNewStatus();

        /** @var TransportEntity $transportEntity */
        foreach ($collection as $transportEntity) {
            $this->send($transportEntity);
        }
    }

    public function send(TransportEntity $transportEntity): void
    {
        $this->sendMessageRepository->send($transportEntity);
        $transportEntity->setStatusId(StatusEnum::COMPLETE);
        $this->getEntityManager()->persist($transportEntity);
    }
}
