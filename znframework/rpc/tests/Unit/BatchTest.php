<?php

namespace ZnLib\Rest\Tests\Unit;

use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnDomain\Validator\Helpers\ValidationHelper;
use ZnFramework\Rpc\Domain\Entities\RpcRequestCollection;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseCollection;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Domain\Enums\RpcVersionEnum;
use ZnTool\Test\Base\BaseTest;

final class BatchTest extends BaseTest {

    public function testEmptyRequestId()
    {
        $requestCollection = new RpcRequestCollection();
        $this->expectException(UnprocessibleEntityException::class);
        $requestEntity = new RpcRequestEntity('partner.oneById', ['id' => 1], [], null);
        ValidationHelper::validateEntity($requestEntity);
        $requestCollection->add($requestEntity);
    }

    public function testEmptyRequestMethod()
    {
        $requestCollection = new RpcRequestCollection();
        $this->expectException(UnprocessibleEntityException::class);
        $requestEntity = new RpcRequestEntity('', ['id' => 1], [], 1);
        ValidationHelper::validateEntity($requestEntity);
        $requestCollection->add($requestEntity);
    }

    public function testEmptyRequestVersion()
    {
        $requestCollection = new RpcRequestCollection();
        $this->expectException(UnprocessibleEntityException::class);
        $requestEntity = new RpcRequestEntity('partner.oneById', ['id' => 1], [], 1);
        $requestEntity->setJsonrpc('');
        ValidationHelper::validateEntity($requestEntity);
        $requestCollection->add($requestEntity);
    }

    public function testEmptyResponseId()
    {
        $requestCollection = new RpcResponseCollection();
        $this->expectException(UnprocessibleEntityException::class);

        $requestEntity = new RpcResponseEntity();
        $requestEntity->setJsonrpc(RpcVersionEnum::V2_0);
        ValidationHelper::validateEntity($requestEntity);
        $requestCollection->add($requestEntity);
    }

    public function testEmptyResponseVersion()
    {
        $requestCollection = new RpcResponseCollection();
        $this->expectException(UnprocessibleEntityException::class);

        $requestEntity = new RpcResponseEntity();
        $requestEntity->setId(1);
        $requestEntity->setJsonrpc('');
        ValidationHelper::validateEntity($requestEntity);
        $requestCollection->add($requestEntity);
    }
}