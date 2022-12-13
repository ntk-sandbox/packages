<?php

namespace ZnFramework\Wsdl\Domain\Repositories\Null;

use ZnFramework\Wsdl\Domain\Entities\TransportEntity;
use ZnFramework\Wsdl\Domain\Enums\StatusEnum;
use ZnFramework\Wsdl\Domain\Interfaces\Repositories\ClientRepositoryInterface;
use ZnFramework\Wsdl\Domain\Libs\SoapClient;
use ZnCore\FileSystem\Helpers\FileStorageHelper;
use ZnDomain\Repository\Base\BaseRepository;

class ClientRepository extends BaseRepository implements ClientRepositoryInterface
{

    public function send(TransportEntity $transportEntity): void
    {
//        $xmlRequest = $transportEntity->getRequest();
//        $url = $transportEntity->getUrl();
//        $client = new SoapClient();
//        $responseXml = $client->sendXmlRequest($xmlRequest, $url);
        $transportEntity->setResponse(FileStorageHelper::load(__DIR__ . '/sendMessageResponse.xml'));
//        $transportEntity->setStatusId(StatusEnum::COMPLETE);
    }
}
