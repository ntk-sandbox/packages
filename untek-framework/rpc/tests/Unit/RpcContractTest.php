<?php

namespace Untek\Lib\Rpc\Tests\Unit;

use Untek\Framework\Rpc\Domain\Enums\RpcErrorCodeEnum;
use Untek\Framework\Rpc\Domain\Enums\RpcVersionEnum;
use Untek\Framework\Rpc\Test\BaseRpcTest;

class RpcContractTest extends BaseRpcTest
{

    public function testEmptyResponse()
    {
        self::markTestSkipped();
        $response = $this->getRpcClient()->sendRequest([]);

        $this->getRpcAssert($response)
            ->assertErrorMessage('Invalid request. Empty request!')
            ->assertErrorCode(RpcErrorCodeEnum::SERVER_ERROR_INVALID_REQUEST);
    }

    public function testEmptyMethod()
    {
        $response = $this->getRpcClient()->sendRequest([
            'jsonrpc' => RpcVersionEnum::V2_0,
            'method' => '',
            'params' => [],
        ]);

        $this->getRpcAssert($response)
            ->assertErrorMessage('Empty method')
            ->assertErrorCode(RpcErrorCodeEnum::SERVER_ERROR_INVALID_REQUEST);
    }

    public function testInvalidVersion()
    {
        $response = $this->getRpcClient()->sendRequest([
            'jsonrpc' => '0.5',
            'method' => 'auth.getToken',
            'params' => [],
        ]);

        $this->getRpcAssert($response)
            ->assertErrorMessage('Unsupported RPC version')
            ->assertErrorCode(RpcErrorCodeEnum::SERVER_ERROR_INVALID_REQUEST);
    }

    public function testEmptyVersion()
    {
        $response = $this->getRpcClient()->sendRequest([
            'jsonrpc' => '',
            'method' => 'auth.getToken',
            'params' => [],
        ]);

        $this->getRpcAssert($response)
            ->assertErrorMessage('Empty RPC version')
            ->assertErrorCode(RpcErrorCodeEnum::SERVER_ERROR_INVALID_REQUEST);
    }

    public function testNotFoundHandler()
    {
        $this->markTestIncomplete();
        $response = $this->sendRequest('qwerty123');

        $this->getRpcAssert($response)
            ->assertErrorMessage('Not found handler')
            ->assertErrorCode(RpcErrorCodeEnum::SERVER_ERROR_METHOD_NOT_FOUND);
    }
}
