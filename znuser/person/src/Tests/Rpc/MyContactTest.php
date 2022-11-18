<?php

namespace ZnUser\Person\Tests\Rpc;

use Tests\Enums\UserEnum;
use Tests\Rpc\BaseTest;

abstract class MyContactTest extends BaseTest
{

    protected function fixtures(): array
    {
        return [
            'person_contact',
        ];
    }

    public function testOne()
    {
        $request = $this->createRequest(UserEnum::ADMIN);
        $request->setMethod('myContact.all');
        $response = $this->sendRequestByEntity($request);
        dd($response);

        $this->getRpcAssert($response)
            ->assertResult([

            ]);
    }

}
