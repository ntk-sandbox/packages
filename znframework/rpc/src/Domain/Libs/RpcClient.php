<?php

namespace ZnFramework\Rpc\Domain\Libs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use ZnCore\Code\Helpers\DeprecateHelper;
use ZnFramework\Rpc\Domain\Encoders\RequestEncoder;
use ZnFramework\Rpc\Domain\Encoders\ResponseEncoder;
use ZnLib\Components\Http\Enums\HttpMethodEnum;
use ZnLib\Components\Http\Helpers\SymfonyHttpResponseHelper;
use ZnSandbox\Sandbox\WebTest\Domain\Facades\TestHttpFacade;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\HttpClient;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\Plugins\JsonAuthPlugin;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\Plugins\JsonPlugin;

DeprecateHelper::hardThrow();

class RpcClient extends BaseRpcClient
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
        $httpClient = $this->createHttpClient();
        $request = $httpClient->createRequest(HttpMethodEnum::POST, '/json-rpc', $body);
        $response = TestHttpFacade::handleRequest($request);
        $headers = SymfonyHttpResponseHelper::extractHeaders($response->headers->all());
        $psr7Response = new \GuzzleHttp\Psr7\Response($response->getStatusCode(), $headers, $response->getContent());
        return $psr7Response;
    }

    protected function createHttpClient(): HttpClient
    {
        $httpClient = new HttpClient();
        $httpClient->withHeader('env-name', 'test');
        $jsonPlugin = new JsonPlugin();
        $httpClient->addPlugin($jsonPlugin);
        $httpClient->addPlugin(new JsonAuthPlugin());

        $jsonPlugin->asJson();
        return $httpClient;
    }


    protected function sendRawRequest_old_(array $body = [])
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
