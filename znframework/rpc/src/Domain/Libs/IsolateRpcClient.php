<?php

namespace ZnFramework\Rpc\Domain\Libs;

use GuzzleHttp\Client;
use ZnFramework\Rpc\Domain\Encoders\RequestEncoder;
use ZnFramework\Rpc\Domain\Encoders\ResponseEncoder;
use ZnLib\Components\Http\Enums\HttpMethodEnum;
use ZnLib\Components\Http\Helpers\SymfonyHttpResponseHelper;
use ZnSandbox\Sandbox\WebTest\Domain\Dto\RequestDataDto;
use ZnSandbox\Sandbox\WebTest\Domain\Facades\TestHttpFacade;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\HttpClient;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\Plugins\JsonAuthPlugin;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\Plugins\JsonPlugin;

class IsolateRpcClient extends BaseRpcClient
{

    public function __construct(
//        protected TestHttpFacade $testHttpFacade,
        RequestEncoder $requestEncoder,
        ResponseEncoder $responseEncoder/*, AuthorizationInterface $authAgent = null*/
    )
    {
        $this->requestEncoder = $requestEncoder;
        $this->responseEncoder = $responseEncoder;
//        $this->setAuthAgent($authAgent);
    }

    protected function sendRawRequest(array $body = [])
    {
        $httpClient = $this->createHttpClient();
        $request = $httpClient->createRequest(HttpMethodEnum::POST, '/json-rpc', $body);
        $response = TestHttpFacade::handleRequest($request);
        return SymfonyHttpResponseHelper::toPsr7Response($response);
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
}
