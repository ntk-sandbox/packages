<?php

namespace Untek\Framework\Rpc\Domain\Libs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelBrowser;
use Untek\Core\Code\Helpers\PropertyHelper;
use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\Domain\Validator\Helpers\ValidationHelper;
use Untek\Lib\Components\Http\Enums\HttpMethodEnum;
use Untek\Lib\Components\Http\Enums\HttpStatusCodeEnum;
use Untek\Lib\Components\Http\Helpers\RestResponseHelper;
use Untek\Framework\Rpc\Domain\Encoders\RequestEncoder;
use Untek\Framework\Rpc\Domain\Encoders\ResponseEncoder;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestCollection;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseCollection;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Framework\Rpc\Domain\Enums\RpcVersionEnum;
use Untek\Framework\Rpc\Domain\Exceptions\InvalidRpcVersionException;
use Untek\Lib\Components\Http\Helpers\SymfonyHttpResponseHelper;
use Untek\Sandbox\Sandbox\WebTest\Domain\Libs\ConsoleHttpKernel;
use Untek\Sandbox\Sandbox\WebTest\Domain\Libs\HttpClient;
use Untek\Sandbox\Sandbox\WebTest\Domain\Libs\Plugins\JsonAuthPlugin;
use Untek\Sandbox\Sandbox\WebTest\Domain\Libs\Plugins\JsonPlugin;

abstract class BaseRpcClient
{

    protected $isStrictMode = true;
    protected $accept = 'application/json';
//    protected $authAgent;
    protected $requestEncoder;
    protected $responseEncoder;
    protected $headers = [];

//    abstract

//    public function __construct(Client $guzzleClient, RequestEncoder $requestEncoder, ResponseEncoder $responseEncoder/*, AuthorizationInterface $authAgent = null*/)
//    {
//        $this->guzzleClient = $guzzleClient;
//        $this->requestEncoder = $requestEncoder;
//        $this->responseEncoder = $responseEncoder;
////        $this->setAuthAgent($authAgent);
//    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /* public function getAuthAgent(): ?AuthorizationInterface
     {
         return $this->authAgent;
     }

     public function setAuthAgent(AuthorizationInterface $authAgent = null)
     {
         $this->authAgent = $authAgent;
     }*/

    public function sendRequestByEntity(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $requestEntity->setJsonrpc(RpcVersionEnum::V2_0);
        if ($requestEntity->getId() == null) {
            $requestEntity->setId(1);
        }
        ValidationHelper::validateEntity($requestEntity);
        $body = EntityHelper::toArray($requestEntity);
        $response = $this->sendRequest($body);
        return $response;
    }

    public function sendBatchRequest(RpcRequestCollection $rpcRequestCollection): RpcResponseCollection
    {
        $arrayBody = [];
        foreach ($rpcRequestCollection->getCollection() as $requestEntity) {
            $requestEntity->setJsonrpc(RpcVersionEnum::V2_0);
            $body = EntityHelper::toArray($requestEntity);
            $arrayBody[] = $this->requestEncoder->encode($body);
        }
        $response = $this->sendRawRequest($arrayBody);
        $data = RestResponseHelper::getBody($response);
        $responseCollection = new RpcResponseCollection();
        foreach ($data as $item) {
            $rpcResponse = new RpcResponseEntity();
            $item = $this->responseEncoder->decode($item);
            PropertyHelper::setAttributes($rpcResponse, $item);
            $responseCollection->add($rpcResponse);
        }
        return $responseCollection;
    }

    public function sendRequest(array $body = []): RpcResponseEntity
    {
        $body = $this->requestEncoder->encode($body);
        $response = $this->sendRawRequest($body);
        if ($this->isStrictMode) {
            $this->validateResponse($response);
        }
        return $this->responseToRpcResponse($response);
    }

    protected function responseToRpcResponse(ResponseInterface $response): RpcResponseEntity
    {
        $data = RestResponseHelper::getBody($response);
        $data = $this->responseEncoder->decode($data);
        $rpcResponse = new RpcResponseEntity();
        if (!is_array($data)) {
//            dd($data);
            throw new \Exception('Empty response');
        }
        PropertyHelper::setAttributes($rpcResponse, $data);
        return $rpcResponse;
    }

    protected function validateResponse(ResponseInterface $response)
    {
        if ($response->getStatusCode() != HttpStatusCodeEnum::OK) {
            throw new \Exception('Status code is not 200');
        }
        $data = RestResponseHelper::getBody($response);
//        dd($data);
        if (is_string($data)) {
            throw new \Exception($data);
        }
        if (is_array($data) && empty($data['jsonrpc'])) {
            throw new InvalidRpcVersionException();
        }
        if (version_compare($data['jsonrpc'], RpcVersionEnum::V2_0, '<')) {
            throw new InvalidRpcVersionException('Unsupported RPC version');
        }
    }
}
