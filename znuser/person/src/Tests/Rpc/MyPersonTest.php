<?php

namespace ZnUser\Person\Tests\Rpc;

use ZnFramework\Rpc\Test\BaseRpcTest;

class MyPersonTest extends BaseRpcTest
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

    /*protected function defaultRpcMethod(): ?string
    {
        return 'person.one';
    }*/

    public function testOne()
    {
        $request = $this->createRequest("admin");
        $request->setMethod('myPerson.one');
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)
            ->assertIsResult()
            ->assertResult(
                [
                    'code' => null,
                    'firstName' => 'Harold',
                    'middleName' => null,
                    'lastName' => 'Fisher',
                    'title' => 'Fisher Harold',
                    'birthday' => '10.01.2013',
                    'sexId' => 1,
                    'statusId' => 100,
                    'contacts' => null,
                    'sex' => null,
                    'identity' => null,
                ]
            );
    }

    public function testUpdate()
    {
        $request = $this->createRequest("admin");
        $request->setMethod('myPerson.update');
        $request->setParams(
            [
                "firstName" => "Root222",
                "middleName" => null,
                "lastName" => "Admin222",
                "birthday" => "10.01.2010",
            ]
        );
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)
            ->assertIsResult();


        $request->setMethod('myPerson.one');
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)
            ->assertIsResult()
            ->assertResult(
                [
                    "code" => null,
                    "firstName" => "Root222",
                    "middleName" => null,
                    "lastName" => "Admin222",
                    "title" => "Admin222 Root222",
                    "birthday" => "10.01.2010",
                    "sexId" => 1,
                    "statusId" => 100,
                    "contacts" => null,
                    "sex" => null,
                    "identity" => null,
                ]
            );
    }
}
