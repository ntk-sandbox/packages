<?php

namespace ZnUser\Authentication\Tests\Rpc\User;


use Tests\Rpc\BaseTest;
use ZnFramework\Rpc\Test\Traits\CrudRpcTestTrait;
use ZnTool\Test\Helpers\TestHelper;

class UserIdentityTest extends BaseTest
{

    use CrudRpcTestTrait;

    protected function getExistedId(): int
    {
        return 2;
    }

    protected function fixtures(): array
    {
        return [

        ];
    }

    protected function baseMethod(): string
    {
        return 'user';
    }

    protected function itemsFileName(): string
    {
        return __DIR__ . '/../data/User/identity.json';
    }

    public function testUnauthorized()
    {
        $this->assertCrudAuth(true, true, true, true, true);
    }

    /*public function testUnauthorized()
    {
        $response = $this->all();
        $this->getRpcAssert($response)->assertUnauthorized();

        $response = $this->findOneById($this->getExistedId());
        $this->getRpcAssert($response)->assertUnauthorized();

        $response = $this->create([]);
        $this->getRpcAssert($response)->assertUnauthorized();

        $response = $this->update([]);
        $this->getRpcAssert($response)->assertUnauthorized();

        $response = $this->deleteById($this->getExistedId());
        $this->getRpcAssert($response)->assertUnauthorized();
    }*/

    public function testAllSuccess()
    {
        $response = $this->all(['perPage' => 1000], 1);
        if (TestHelper::isRewriteData()) {
            $this->getRepository()->dumpDataProvider($response, [
                'id',
                'statusId',
                'createdAt',
                'updatedAt',
                'username',
            ]);
        }
        $this->getRpcAssert($response)->assertResult($this->getRepository()->allAsArray());
    }

    public function testPaginationSuccess()
    {
        $response = $this->all(['perPage' => 1], 1);
        $this->getRpcAssert($response)->assertResult([$this->getRepository()->findOneByIdAsArray($this->getFirstId())]);
        $this->getRpcAssert($response)->assertPagination($this->getTotalCount(), 1, 1, 1);

        $response = $this->all(['perPage' => 1, 'page' => 2], 1);
        $this->getRpcAssert($response)->assertResult([$this->getRepository()->findOneByIdAsArray($this->getFirstId() + 1)]);
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
        $response = $this->create([
            'username' => 'Custom 1',
//            'password' => '4444444444444',
        ], 1);
        $this->getRpcAssert($response)->assertResult([
            "id" => $this->getNextId(),
            "username" => "Custom 1",
        ]);

        // check created entity
        $this->assertItem([
            "id" => $this->getNextId(),
            "username" => "Custom 1",
        ], 1);
    }

    public function testCreateForbidden()
    {
        $response = $this->create([], 7);
        $this->getRpcAssert($response)->assertForbidden();

        // check created entity
        $this->assertNotFoundById($this->getNextId(), 1);
    }

    public function testUpdateSuccess()
    {
        $response = $this->update([
            'id' => $this->getExistedId(),
            'username' => 'Custom 1',
        ], 1);

        $this->getRpcAssert($response)->assertResult([
            "id" => $this->getExistedId(),
            "username" => "Custom 1",
        ]);

        // check updated entity
        $this->assertItem([
            "id" => $this->getExistedId(),
            "username" => "Custom 1",
        ], 1);
    }

    public function testUpdateForbidden()
    {
        $response = $this->update([], 7);
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
