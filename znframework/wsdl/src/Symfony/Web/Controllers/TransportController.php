<?php

namespace Untek\Framework\Wsdl\Symfony\Web\Controllers;

use Untek\Framework\Wsdl\Domain\Interfaces\Services\RequestServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Untek\Lib\Web\Xml\Libs\XmlResponse;

class TransportController
{

    private $requestService;

    public function __construct(
        RequestServiceInterface $requestService
    )
    {
        $this->requestService = $requestService;
    }

    public function index(Request $request): Response
    {
        $responseXml = $this->requestService->runRequest($request->getContent());
        $response = new XmlResponse();
        $response->setContent($responseXml);
        return $response;
    }

    /*public function callProcedure(Request $request): Response
    {
        $this->requestService->addRequest($request->getContent());
        $this->requestService->runQueue();
        $responseXml = '<?xml version="1.0" encoding="UTF-8"?>
<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="http://bip.bee.kz/AsyncChannel/v10/Types">
    <SOAP-ENV:Body>
        <ns1:sendMessageResponse/>
    </SOAP-ENV:Body>
</SOAP-ENV:Envelope>';

        $response = new XmlResponse();
        $response->setContent($responseXml);
        return $response;
    }*/
}
