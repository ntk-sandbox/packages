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

class TestRpcProvider extends RpcProvider
{

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
}
