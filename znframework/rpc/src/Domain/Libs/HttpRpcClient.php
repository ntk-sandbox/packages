<?php

namespace Untek\Framework\Rpc\Domain\Libs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use Untek\Framework\Rpc\Domain\Encoders\RequestEncoder;
use Untek\Framework\Rpc\Domain\Encoders\ResponseEncoder;
use Untek\Lib\Components\Http\Enums\HttpMethodEnum;

class HttpRpcClient extends BaseRpcClient
{

    protected $guzzleClient;

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

    /*public function getGuzzleClient(): Client
    {
        return $this->guzzleClient;
    }

    public function setGuzzleClient(Client $guzzleClient): void
    {
        $this->guzzleClient = $guzzleClient;
    }*/

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
