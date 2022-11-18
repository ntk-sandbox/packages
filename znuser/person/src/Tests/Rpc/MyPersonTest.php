<?php

namespace ZnUser\Person\Tests\Rpc;

use Tests\Enums\UserEnum;
use Tests\Rpc\BaseTest;

class MyPersonTest extends BaseTest
{

    protected function fixtures(): array
    {
        return [
//            'money_transaction',
//            'money_wallet',
        ];
    }

    /*protected function defaultRpcMethod(): ?string
    {
        return 'person.one';
    }*/

    public function testOne()
    {
        $request = $this->createRequest(UserEnum::ADMIN);
        $request->setMethod('myPerson.one');
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)
            ->assertIsResult()
            ->assertResult([
                'code' => NULL,
                'firstName' => 'Harold',
                'middleName' => NULL,
                'lastName' => 'Fisher',
                'title' => 'Fisher Harold',
                'birthday' => '10.01.2013',
                'sexId' => 1,
                'statusId' => 100,
                'contacts' => NULL,
                'sex' => NULL,
                'identity' => NULL,
            ]);
    }

    public function testUpdate()
    {
        $request = $this->createRequest(UserEnum::ADMIN);
        $request->setMethod('myPerson.update');
        $request->setParams([
            "firstName" => "Root222",
            "middleName" => null,
            "lastName" => "Admin222",
            "birthday" => "10.01.2010",
        ]);
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)
            ->assertIsResult();


        $request->setMethod('myPerson.one');
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)
            ->assertIsResult()
            ->assertResult([
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
            ]);
    }
}
