<?php

namespace Untek\Framework\Rpc\Domain\Libs;

use GuzzleHttp\Client;
use Untek\Framework\Rpc\Domain\Encoders\RequestEncoder;
use Untek\Framework\Rpc\Domain\Encoders\ResponseEncoder;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Framework\Rpc\Domain\Enums\HttpHeaderEnum;
use Untek\Framework\Rpc\Domain\Forms\BaseRpcAuthForm;
use Untek\Framework\Rpc\Domain\Forms\RpcAuthByLoginForm;
use Untek\Framework\Rpc\Domain\Forms\RpcAuthByTokenForm;
use Untek\Framework\Rpc\Domain\Forms\RpcAuthGuestForm;
use Untek\Framework\Rpc\Domain\Interfaces\Encoders\RequestEncoderInterface;
use Untek\Framework\Rpc\Domain\Interfaces\Encoders\ResponseEncoderInterface;

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
