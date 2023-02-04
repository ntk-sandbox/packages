<?php

namespace Tests\Rpc\Application;

use Untek\Framework\Rpc\Test\BaseRpcTest;
use Untek\Framework\Rpc\Test\Traits\CrudRpcTestTrait;
use Untek\Tool\Test\Helpers\TestHelper;

abstract class ApplicationTest extends BaseRpcTest
{

    use CrudRpcTestTrait;

    protected function getExistedId(): int
    {
        return 2;
    }

    protected function getTotalCount(): int
    {
        return $this->getRepository()->getTotal();
    }

    protected function fixtures(): array
    {
        return [
            'rpc_route',
            'user_credential',
            'user_token',
            'rbac_assignment',
            'rbac_inheritance',
            'settings_system',
            'application_application',
        ];
    }

    protected function baseMethod(): string
    {
        return 'application';
    }

    protected function itemsFileName(): string
    {
        return __DIR__ . '/../../data/Application/application.php';
    }

    public function testUnauthorized()
    {
        $this->assertCrudAuth(true, true, true, true, true);
    }

    public function testAllSuccess()
    {
        $response = $this->all(['perPage' => 1000], 1);
        if (TestHelper::isRewriteData()) {
            $this->getRepository()->dumpDataProvider($response);
//            $this->getRepository()->dumpAll($response->getResult());
        }
        $this->getRpcAssert($response)->assertResult($this->getRepository()->allAsArray());
    }

    public function testPaginationSuccess()
    {
        $response = $this->all(['perPage' => 1], 1);
        $this->getRpcAssert($response)->assertResult([$this->getRepository()->findOneByIdAsArray($this->getFirstId())]);
        $this->getRpcAssert($response)->assertPagination($this->getTotalCount(), 1, 1, 1);

        $response = $this->all(['perPage' => 1, 'page' => 2], 1);
        $this->getRpcAssert($response)->assertResult(
            [$this->getRepository()->findOneByIdAsArray($this->getFirstId() + 1)]
        );
        $this->getRpcAssert($response)->assertPagination($this->getTotalCount(), 1, 1, 2);
    }

    public function testAllForbidden()
    {
        $response = $this->all([], 7);
        $this->getRpcAssert($response)->assertForbidden();
    }

    public function testOneByIdSuccess()
    {
        $response = $this->findOneById($this->getExistedId(), 1);
        $this->getRpcAssert($response)->assertResult($this->getRepository()->findOneByIdAsArray($this->getExistedId()));
    }

    public function testOneByIdForbidden()
    {
        $response = $this->findOneById($this->getExistedId(), 7);
        $this->getRpcAssert($response)->assertForbidden();
    }

    public function testCreateSuccess()
    {
        $response = $this->create(
            [
                'title' => 'Custom 1',
                'status_id' => 100,
            ],
            1
        );
        $this->getRpcAssert($response)->assertResult(
            [
                //"id" => $this->getNextId(),
                "title" => "Custom 1",
                "statusId" => 100,
            ]
        );

        // check created entity
        $this->assertItem(
            [
                "id" => $this->getNextId(),
//            "title" => "Custom 1",
//            "statusId" => 100,
            ],
            1
        );
    }

    public function testCreateForbidden()
    {
        $response = $this->create(
            [
                'title' => 'Custom 1',
                'status_id' => 100,
            ],
            7
        );
        $this->getRpcAssert($response)->assertForbidden();

        // check created entity
        $this->assertNotFoundById($this->getNextId(), 1);
    }

    public function testUpdateSuccess()
    {
        $response = $this->update(
            [
                'id' => $this->getExistedId(),
                'title' => 'Custom 1',
            ],
            1
        );

        $this->getRpcAssert($response)->assertResult(
            [
                "id" => $this->getExistedId(),
                "title" => "Custom 1",
                "statusId" => 100,
            ]
        );

        // check updated entity
        $this->assertItem(
            [
                "id" => $this->getExistedId(),
                "title" => "Custom 1",
                "statusId" => 100,
            ],
            1
        );
    }

    public function testUpdateForbidden()
    {
        $response = $this->update(
            [
                'id' => $this->getExistedId(),
                'title' => 'Custom 1',
            ],
            7
        );
        $this->getRpcAssert($response)->assertForbidden();

        // check updated entity
        $this->assertExistsById($this->getExistedId(), 1);
    }

    public function testDeleteSuccess()
    {
        $id = $this->getExistedId();
        $this->assertDeleteById($id, 1, true);
        /*$response = $this->deleteById($this->getExistedId(), 1);
        $this->getRpcAssert($response)->assertIsResult();

        // check deleted entity
        $this->assertNotFoundById($this->getExistedId(), "admin");*/
    }

    public function testDeleteForbidden()
    {
        $response = $this->deleteById($this->getExistedId(), 7);
        $this->getRpcAssert($response)->assertForbidden();

        // check deleted entity
        $this->assertExistsById($this->getExistedId(), 1);
    }
}
