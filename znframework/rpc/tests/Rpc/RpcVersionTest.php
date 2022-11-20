<?php

namespace ZnLib\Rpc\Tests\Rpc;

use Tests\Rpc\BaseTest;
use ZnFramework\Rpc\Domain\Enums\HttpHeaderEnum;
use ZnFramework\Rpc\Domain\Enums\RpcErrorCodeEnum;

class RpcVersionTest extends BaseTest
{

    protected function fixtures(): array
    {
        return [
            'summary_attempt',
        ];
    }

    protected function defaultRpcMethod(): ?string
    {
        return 'authentication.getTokenByPassword';
    }

    protected function defaultRpcMethodVersion(): ?int
    {
        return 9999;
    }

    public function testGetTokenSuccess()
    {
        $request = $this->createRequest();
        $request->setMetaItem(HttpHeaderEnum::VERSION, 1);
        $request->setParams([
            'login' => "admin",
            'password' => "Wwwqqq111",
        ]);

        $response = $this->sendRequestByEntity($request);
        $result = $response->getResult();
        $token = $result['token'];

        $this->assertStringContainsString('bearer', $token);
    }

    public function testGetTokenFail()
    {
        $request = $this->createRequest();
        $request->setMetaItem(HttpHeaderEnum::VERSION, 2);
        $request->setParams([
            'login' => "admin",
            'password' => "Wwwqqq111",
        ]);

        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)->assertErrorCode(RpcErrorCodeEnum::SERVER_ERROR_METHOD_NOT_FOUND);
        $this->getRpcAssert($response)->assertErrorMessage('Not found RPC-method handler');
    }
}
