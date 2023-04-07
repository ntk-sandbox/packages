<?php

namespace Untek\Framework\Wsdl\Domain\Repositories\Wsdl;

use Untek\Framework\Wsdl\Domain\Entities\TransportEntity;
use Untek\Framework\Wsdl\Domain\Enums\StatusEnum;
use Untek\Framework\Wsdl\Domain\Interfaces\Repositories\ClientRepositoryInterface;
use Untek\Framework\Wsdl\Domain\Libs\SoapClient;
use Untek\Model\Repository\Base\BaseRepository;

class ClientRepository extends BaseRepository implements ClientRepositoryInterface
{

    public function send(TransportEntity $transportEntity): void
    {
        $xmlRequest = $transportEntity->getRequest();
        $url = $transportEntity->getUrl();
        $client = new SoapClient();
        $responseXml = $client->sendXmlRequest($xmlRequest, $url);
        $transportEntity->setResponse($responseXml);
//        $transportEntity->setStatusId(StatusEnum::COMPLETE);
    }
}
