<?php

namespace ZnFramework\Rpc\Domain\Libs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use ZnFramework\Rpc\Domain\Encoders\RequestEncoder;
use ZnFramework\Rpc\Domain\Encoders\ResponseEncoder;
use ZnLib\Components\Http\Enums\HttpMethodEnum;

class HttpRpcClient extends BaseRpcClient
{

    public function __construct(
        Client $guzzleClient,
        RequestEncoder $requestEncoder,
        ResponseEncoder $responseEncoder/*, AuthorizationInterface $authAgent = null*/
    )
    {
        $this->guzzleClient = $guzzleClient;
        $this->requestEncoder = $requestEncoder;
        $this->responseEncoder = $responseEncoder;
//        $this->setAuthAgent($authAgent);
    }

    protected function sendRawRequest(array $body = [])
    {
        $options = [
            RequestOptions::JSON => $body,
            RequestOptions::HEADERS => $this->headers,
        ];
        $options[RequestOptions::HEADERS]['Accept'] = $this->accept;
        try {
            $response = $this->guzzleClient->request(HttpMethodEnum::POST, '', $options);
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if ($response == null) {
                throw new \Exception('Url not found!');
            }
        }
        return $response;
    }
}
