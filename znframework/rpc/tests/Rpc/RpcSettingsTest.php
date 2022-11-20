<?php

namespace ZnLib\Rpc\Tests\Rpc;

use ZnFramework\Rpc\Test\BaseRpcTest;

class RpcSettingsTest extends BaseRpcTest
{

    protected function fixtures(): array
    {
        return [
            'rpc_route',
            'user_credential',
            'user_token',
            'rbac_assignment',
            'rbac_inheritance',
            'settings_system',
        ];
    }

    public function testViewSuccess()
    {
        $this->markTestIncomplete();

        $request = $this->createRequest(1);
        $request->setMethod('rpcSettings.view');
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)
            ->assertResult([
                "cryptoProviderStrategy" => "default",
                "waitReceiptNotification" => false,
                "requireTimestamp" => false,

                /*
                "cryptoProviderStrategy" => "jsonDSig",
                "waitReceiptNotification" => true,
                "requireTimestamp" => true,
                */
            ]);
    }

    public function testUpdateSuccess()
    {
        $this->markTestIncomplete();

        $request = $this->createRequest(1);
        $request->setMethod('rpcSettings.update');
        $request->setParams([
            "cryptoProviderStrategy" => "default",
            "waitReceiptNotification" => false,
            "requireTimestamp" => false,
        ]);
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)
            ->assertIsResult();

        // check result
        $request->setMethod('rpcSettings.view');
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)
            ->assertResult([
                "cryptoProviderStrategy" => "default",
                "waitReceiptNotification" => false,
                "requireTimestamp" => false,
            ]);
    }

    public function testPartialUpdateSuccess()
    {
        $this->markTestIncomplete();

        $request = $this->createRequest(1);
        $request->setMethod('rpcSettings.update');
        $request->setParams([
            "cryptoProviderStrategy" => "default",
        ]);
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)
            ->assertIsResult();

        // check result
        $request->setMethod('rpcSettings.view');
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)
            ->assertResult([
                "cryptoProviderStrategy" => "default",
                "waitReceiptNotification" => false,
                "requireTimestamp" => false,
//                "waitReceiptNotification" => true,
//                "requireTimestamp" => true,
            ]);
    }

    public function testUpdateValidation()
    {
        $this->markTestIncomplete();

        $request = $this->createRequest(1);
        $request->setMethod('rpcSettings.update');
        $request->setParams([
            "cryptoProviderStrategy" => "default111",
            "waitReceiptNotification" => false,
            "requireTimestamp" => false,
        ]);
        $response = $this->sendRequestByEntity($request);

        $expected = [
            [
                "field" => "cryptoProviderStrategy",
                "message" => "Выбранное Вами значение недопустимо.",
            ],
        ];
        $this->getRpcAssert($response)->assertUnprocessableEntityErrors($expected);
    }
}
