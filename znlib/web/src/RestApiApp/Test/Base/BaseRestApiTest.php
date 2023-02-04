<?php

namespace Untek\Lib\Web\RestApiApp\Test\Base;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelBrowser;
use Untek\Lib\Web\RestApiApp\Test\Asserts\RestApiAssert;
use Untek\Sandbox\Sandbox\WebTest\Domain\Facades\TestHttpFacade;
use Untek\Sandbox\Sandbox\WebTest\Domain\Libs\ConsoleHttpKernel;
use Untek\Sandbox\Sandbox\WebTest\Domain\Libs\HttpClient;
use Untek\Sandbox\Sandbox\WebTest\Domain\Libs\Plugins\JsonAuthPlugin;
use Untek\Sandbox\Sandbox\WebTest\Domain\Libs\Plugins\JsonPlugin;
use Untek\Tool\Test\Base\BaseTestCase;

abstract class BaseRestApiTest extends BaseTestCase
{

    protected function printData(Response $response)
    {
        $responseBody = json_decode($response->getContent(), JSON_OBJECT_AS_ARRAY);

        dd($responseBody);
    }

    protected function getRestApiAssert(Response $response = null): RestApiAssert
    {
        $assert = new RestApiAssert($response);
        return $assert;
    }

    protected function sendResponse(string $method, string $uri, $data = null): Response
    {
        $httpClient = $this->createHttpClient();
        $request = $httpClient->createRequest($method, $uri, $data);
        $response = TestHttpFacade::handleRequestViaBrowser($request);

//        $httpKernel = TestHttpFacade::createHttpKernel();
//        $response = $httpKernel->handle($request);

        return $response;
    }

    protected function createHttpClient(): HttpClient
    {
        $httpClient = new HttpClient();
        $httpClient->withHeader('env-name', 'test');
        $httpClient->addPlugin(new JsonPlugin());
        $httpClient->addPlugin(new JsonAuthPlugin());

        /** @var JsonAuthPlugin $jsonAuthPlugin */
        $jsonAuthPlugin = $httpClient->getPlugin(JsonAuthPlugin::class);
//        $jsonAuthPlugin->withToken('');

        /** @var JsonPlugin $jsonPlugin */
        $jsonPlugin = $httpClient->getPlugin(JsonPlugin::class);
        $jsonPlugin->asJson();
        return $httpClient;
    }
}
