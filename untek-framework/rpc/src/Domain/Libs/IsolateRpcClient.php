<?php

namespace Untek\Framework\Rpc\Domain\Libs;

use GuzzleHttp\Client;
use Untek\Framework\Rpc\Domain\Encoders\RequestEncoder;
use Untek\Framework\Rpc\Domain\Encoders\ResponseEncoder;
use Untek\Component\Http\Enums\HttpMethodEnum;
use Untek\Component\Http\Helpers\SymfonyHttpResponseHelper;
use Untek\Sandbox\Sandbox\WebTest\Domain\Dto\RequestDataDto;
use Untek\Sandbox\Sandbox\WebTest\Domain\Facades\TestHttpFacade;
use Untek\Sandbox\Sandbox\WebTest\Domain\Libs\HttpClient;
use Untek\Sandbox\Sandbox\WebTest\Domain\Libs\Plugins\JsonAuthPlugin;
use Untek\Sandbox\Sandbox\WebTest\Domain\Libs\Plugins\JsonPlugin;

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
//        $response = TestHttpFacade::handleRequest($request);

        $httpKernel = TestHttpFacade::createHttpKernel();
        $response = $httpKernel->handle($request);

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
