<?php

namespace Untek\User\Rbac\Tests\Rpc;

use Untek\Framework\Rpc\Test\BaseRpcTest;
use Untek\User\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

class RbacAssignmentTest extends BaseRpcTest
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

    public function testAttachExistedError()
    {
        $this->markTestSkipped('Need fix DB increment anomaly');

        $request = $this->createRequest(1);
        $request->setMethod('rbacAssignment.attach');
        $request->setParams(
            [
                "identityId" => 7,
                "itemName" => SystemRoleEnum::ADMINISTRATOR,
            ]
        );
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)->assertIsResult();

        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)->assertErrorMessage('Assignment already exists');
    }

    public function testAttachUnprocessableError()
    {
        $request = $this->createRequest(1);
        $request->setMethod('rbacAssignment.attach');
        $request->setParams(
            [
                "identityId" => 9999,
                "itemName" => 'qwertyu',
            ]
        );
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)->assertUnprocessableEntityErrors(
            [
                [
                    'field' => 'identityId',
                    'message' => 'User not found',
                ],
                [
                    'field' => 'itemName',
                    'message' => 'Item not found',
                ],
            ]
        );
    }

    public function testDetachUnprocessableError()
    {
        $request = $this->createRequest(1);
        $request->setMethod('rbacAssignment.detach');
        $request->setParams(
            [
                "identityId" => 9999,
                "itemName" => 'qwertyu',
            ]
        );
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)->assertUnprocessableEntityErrors(
            [
                [
                    'field' => 'identityId',
                    'message' => 'User not found',
                ],
                [
                    'field' => 'itemName',
                    'message' => 'Item not found',
                ],
            ]
        );
    }

    public function testDetachNotFoundError()
    {
        $request = $this->createRequest(1);
        $request->setMethod('rbacAssignment.detach');
        $request->setParams(
            [
                "identityId" => 6,
                "itemName" => SystemRoleEnum::USER,
            ]
        );
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)->assertIsResult();

        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)
            ->assertNotFound();
    }

    public function testAttachAndDetach()
    {
        $this->markTestSkipped('Need fix DB increment anomaly');

        $request = $this->createRequest(1);
        $request->setMethod('rbacAssignment.attach');
        $request->setParams(
            [
                "identityId" => 7,
                "itemName" => SystemRoleEnum::ADMINISTRATOR,
            ]
        );
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)->assertIsResult();

        $request = $this->createRequest(7);
        $request->setMethod('rbacRole.all');
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)->assertIsResult();

        $request = $this->createRequest(1);
        $request->setMethod('rbacAssignment.detach');
        $request->setParams(
            [
                "identityId" => 7,
                "itemName" => SystemRoleEnum::ADMINISTRATOR,
            ]
        );
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)->assertIsResult();

        $request = $this->createRequest(7);
        $request->setMethod('rbacRole.all');
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)->assertForbidden();
    }

    public function testAllRoles()
    {
        $request = $this->createRequest(1);
        $request->setMethod('rbacAssignment.allRoles');
        $request->setParams(
            [
                "identityId" => 6,
            ]
        );
        $response = $this->sendRequestByEntity($request);
        $this->getRpcAssert($response)->assertCollection(
            [
                [
                    "id" => 6,
                    "identityId" => 6,
                    "itemName" => SystemRoleEnum::USER,
                    "statusId" => 100,
                ],
            ]
        );
    }
}
