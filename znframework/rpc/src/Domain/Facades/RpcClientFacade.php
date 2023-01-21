<?php

namespace ZnFramework\Rpc\Domain\Facades;

use ZnCore\Env\Enums\EnvEnum;
use ZnCore\Env\Helpers\EnvHelper;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Domain\Libs\RpcProvider;

class RpcClientFacade
{

    private $authLogin;
    private $authPassword;
    private $appEnv;

    public function __construct(string $appEnv)
    {
        $this->appEnv = $appEnv/* ?: getenv('APP_ENV')*/;
    }

    public function authBy(string $authLogin = null, string $authPassword = null)
    {
        $this->authLogin = $authLogin;
        $this->authPassword = $authPassword;
    }

    public function send(RpcRequestEntity $request, string $authLogin = null, string $authPassword = null): RpcResponseEntity
    {
        $authLogin = $authLogin ?: $this->authLogin;
        $authPassword = $authPassword ?: $this->authPassword;

        $rpcProvider = self::createRpcProvider(getenv('RPC_URL'));
        $rpcProvider->authByLogin($authLogin, $authPassword);

//        $authProvider = new RpcAuthProvider($rpcProvider);
//        $authorizationToken = $authProvider->authBy($authLogin, $authPassword);

        //$request = new RpcRequestEntity();
//        $request->addMeta(HttpHeaderEnum::AUTHORIZATION, $authorizationToken);


        //$request->setMethod('requestMessage.all');

        $response = $rpcProvider->sendRequestByEntity($request);
        return $response;
    }

    public function createRpcProvider(string $baseUrl, int $rpcVersion = 1): RpcProvider
    {
        $rpcProvider = new RpcProvider();
        $rpcProvider->setBaseUrl($baseUrl);
        if ($this->appEnv == EnvEnum::TEST) {
            $rpcProvider->getRpcClient()->setHeaders([
                'env-name' => 'test',
            ]);
        }
        $rpcProvider->setDefaultRpcMethodVersion($rpcVersion);
        return $rpcProvider;
    }
}
