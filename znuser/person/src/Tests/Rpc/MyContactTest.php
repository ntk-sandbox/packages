<?php

namespace Untek\User\Person\Tests\Rpc;

use Untek\Framework\Rpc\Test\BaseRpcTest;

abstract class MyContactTest extends BaseRpcTest
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
            'person_contact',
        ];
    }

    public function testOne()
    {
        $request = $this->createRequest("admin");
        $request->setMethod('myContact.all');
        $response = $this->sendRequestByEntity($request);
        dd($response);

        $this->getRpcAssert($response)
            ->assertResult([

            ]);
    }

}
