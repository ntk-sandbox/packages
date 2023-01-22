<?php

namespace ZnFramework\Rpc\Domain\Libs;

use GuzzleHttp\Client;
use ZnFramework\Rpc\Domain\Encoders\RequestEncoder;
use ZnFramework\Rpc\Domain\Encoders\ResponseEncoder;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Domain\Enums\HttpHeaderEnum;
use ZnFramework\Rpc\Domain\Forms\BaseRpcAuthForm;
use ZnFramework\Rpc\Domain\Forms\RpcAuthByLoginForm;
use ZnFramework\Rpc\Domain\Forms\RpcAuthByTokenForm;
use ZnFramework\Rpc\Domain\Forms\RpcAuthGuestForm;
use ZnFramework\Rpc\Domain\Interfaces\Encoders\RequestEncoderInterface;
use ZnFramework\Rpc\Domain\Interfaces\Encoders\ResponseEncoderInterface;

class RpcProvider
{

    protected $requestEncoder;
    protected $responseEncoder;
//    protected $defaultPassword = 'Wwwqqq111';
    protected $defaultRpcMethod;
    protected $defaultRpcMethodVersion = 1;
    protected $rpcClient;
    protected $baseUrl;

    /** @var RpcAuthProvider */
    private $authProvider;
    private $authToken;

    public function __construct(RequestEncoderInterface $requestEncoder = null, ResponseEncoderInterface $responseEncoder = null)
    {
        $this->requestEncoder = $requestEncoder ?? new RequestEncoder();
        $this->responseEncoder = $responseEncoder ?? new ResponseEncoder();
    }

    public function getAuthProvider(): RpcAuthProvider
    {
        return $this->authProvider ?: new RpcAuthProvider($this);
    }

    public function setAuthProvider(RpcAuthProvider $authProvider): void
    {
        $this->authProvider = $authProvider;
    }

    /*protected function getAuthorizationContract(Client $guzzleClient): AuthorizationInterface
    {
        return new BearerAuthorization($guzzleClient);
    }*/

    public function getRpcClient(): BaseRpcClient
    {
        if (empty($this->rpcClient)) {
            $guzzleClient = $this->getGuzzleClient();
//            $authAgent = $this->getAuthorizationContract($guzzleClient);
//            $this->rpcClient = new HttpRpcClient($guzzleClient, $this->requestEncoder, $this->responseEncoder/*, $authAgent*/);
            $this->rpcClient = new IsolateRpcClient($this->requestEncoder, $this->responseEncoder/*, $authAgent*/);
//            $this->rpcClient = new RpcClient($guzzleClient, $this->requestEncoder, $this->responseEncoder/*, $authAgent*/);
        }
        return $this->rpcClient;
    }

    protected function getGuzzleClient(): Client
    {
        $config = [
            'base_uri' => $this->getBaseUrl(),
        ];
        $client = new Client($config);
        return $client;
    }

    protected function getBaseUrl(): string
    {
        if (empty($this->baseUrl)) {
            /** @todo костыль */
            $this->setBaseUrl(getenv('RPC_URL'));
        }
        return $this->baseUrl;
    }

    public function setBaseUrl($baseUrl): void
    {
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    public function getDefaultRpcMethod()
    {
        return $this->defaultRpcMethod;
    }

    public function setDefaultRpcMethod($defaultRpcMethod): void
    {
        $this->defaultRpcMethod = $defaultRpcMethod;
    }

    public function getDefaultRpcMethodVersion(): int
    {
        return $this->defaultRpcMethodVersion;
    }

    public function setDefaultRpcMethodVersion(int $defaultRpcMethodVersion): void
    {
        $this->defaultRpcMethodVersion = $defaultRpcMethodVersion;
    }

    public function prepareRequestEntity(RpcRequestEntity $requestEntity): void
    {
        if ($requestEntity->getMetaItem(HttpHeaderEnum::VERSION) == null && $this->getDefaultRpcMethodVersion()) {
            $requestEntity->setMetaItem(HttpHeaderEnum::VERSION, $this->getDefaultRpcMethodVersion());
        }
        $requestEntity->setMetaItem(HttpHeaderEnum::TIMESTAMP, date(\DateTime::ISO8601));
    }

    public function authByLogin(string $login, string $password): void
    {
        $this->authByForm(new RpcAuthByLoginForm($login, $password));
//        $this->authToken = $this->getAuthProvider()->authBy($login, $password);
    }

    public function authByForm(BaseRpcAuthForm $authForm): void
    {
        $this->authToken = $this->getTokenByForm($authForm);
    }

    public function getTokenByForm(BaseRpcAuthForm $authForm): ?string
    {
        $token = null;
        if ($authForm instanceof RpcAuthGuestForm) {
            $token = null;
        }
        if ($authForm instanceof RpcAuthByLoginForm) {
            $token = $this
                ->getAuthProvider()
                ->authBy($authForm->getLogin(), $authForm->getPassword());
        }
        if ($authForm instanceof RpcAuthByTokenForm) {
            $token = $authForm->getToken();
        }
        return $token;
    }

    protected function prepareAuth(RpcRequestEntity $requestEntity, ?BaseRpcAuthForm $authForm): void
    {
        if (!$authForm && $this->authToken) {
            $requestEntity->addMeta(HttpHeaderEnum::AUTHORIZATION, $this->authToken);
        } elseif ($authForm) {
            $token = $this->getTokenByForm($authForm);
            $requestEntity->addMeta(HttpHeaderEnum::AUTHORIZATION, $token);
        }
    }

    public function sendRequestByEntity(RpcRequestEntity $requestEntity, ?BaseRpcAuthForm $authForm = null): RpcResponseEntity
    {
        $this->prepareRequestEntity($requestEntity);
        $this->prepareAuth($requestEntity, $authForm);
        return $this
            ->getRpcClient()
            ->sendRequestByEntity($requestEntity);
    }

    /*public function sendRequest(string $method, array $params = [], array $meta = [], int $id = null): RpcResponseEntity
    {
        $request = new RpcRequestEntity();
        $request->setMethod($method);
        $request->setParams($params);
        $request->setMeta($meta);
        $request->setId($id);
        $response = $this->sendRequestByEntity($request);
        return $response;
    }*/
}
