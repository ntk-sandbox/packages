<?php

namespace Untek\Framework\Rpc\Test\Traits;

use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Framework\Rpc\Test\Enums\CrudMethodEnum;
use Untek\Framework\Rpc\Test\RpcAssert;
use Untek\Lib\Components\Http\Enums\HttpStatusCodeEnum;

trait CrudRpcTestTrait
{

    use RepositoryTestTrait;

    abstract protected function baseMethod(): string;

    abstract protected function createRequest($login = null): RpcRequestEntity;

    abstract protected function getRpcAssert(RpcResponseEntity $response = null): RpcAssert;

//    abstract protected function getExistedId(): int;

    protected function itemsFileName(): string
    {
    }

    protected function getNextId(): int
    {
        return $this->getRepository()->getTotal() + 1;
    }

    protected function getFirstId(): int
    {
        return 1;
    }

    protected function getTotalCount(): int
    {
        return $this->getRepository()->getTotal();
    }

    protected function all(array $data = [], string $login = null): RpcResponseEntity
    {
        $request = $this->createRequest($login);
        $request->setMethod($this->baseMethod() . '.' . $this->getMethod(CrudMethodEnum::METHOD_ALL));
        $request->setParams($data);
        return $this->sendRequestByEntity($request);
    }

    protected function create(array $data, string $login = null): RpcResponseEntity
    {
        $request = $this->createRequest($login);
        $request->setMethod($this->baseMethod() . '.' . $this->getMethod(CrudMethodEnum::METHOD_CREATE));
        $request->setParams($data);
        return $this->sendRequestByEntity($request);
    }

    protected function update(array $data, string $login = null): RpcResponseEntity
    {
        $request = $this->createRequest($login);
        $request->setMethod($this->baseMethod() . '.' . $this->getMethod(CrudMethodEnum::METHOD_UPDATE));
        $request->setParams($data);
        return $this->sendRequestByEntity($request);
    }

    protected function deleteById(int|string $id, string $login = null): RpcResponseEntity
    {
        $request = $this->createRequest($login);
        $request->setMethod($this->baseMethod() . '.' . $this->getMethod(CrudMethodEnum::METHOD_DELETE));
        $request->setParamItem('id', $id);
        return $this->sendRequestByEntity($request);
    }

    protected function getMethod(string $name): string
    {
        return $this->crudMethodMap()[$name];
    }

    protected function crudMethodMap(): array
    {
        return [
            'all' => 'all',
            'oneById' => 'oneById',
            'create' => 'create',
            'update' => 'update',
            'delete' => 'delete',
        ];
    }

    /**
     * @param int|string $id
     * @param string|null $login
     * @param array $params
     * @return RpcResponseEntity
     * @deprecated
     */
    protected function oneById(int|string $id, string $login = null, array $params = []): RpcResponseEntity
    {
        $request = $this->createRequest($login);
        $request->setMethod($this->baseMethod() . '.' . $this->getMethod(CrudMethodEnum::METHOD_ONE_BY_ID));
        $request->setParamItem('id', $id);
        if ($params) {
            foreach ($params as $paramKey => $paramValue) {
                $request->setParamItem($paramKey, $paramValue);
            }
        }
        return $this->sendRequestByEntity($request);
    }

    protected function pkName(): string {
        return 'id';
    }

    protected function findOneById(int|string $id, string $login = null, array $params = []): RpcResponseEntity
    {
        $request = $this->createRequest($login);
        $request->setMethod($this->baseMethod() . '.' . $this->getMethod(CrudMethodEnum::METHOD_ONE_BY_ID));
        $request->setParamItem($this->pkName(), $id);
        if ($params) {
            foreach ($params as $paramKey => $paramValue) {
                $request->setParamItem($paramKey, $paramValue);
            }
        }
        return $this->sendRequestByEntity($request);
    }

    protected function assertExistsById(int|string $id, string $login = null)
    {
        $response = $this->findOneById($id, $login);
        $expectedItem = $this->getRepository()->findOneByIdAsArray($id);
        $this->getRpcAssert($response)->assertResult(['id' => $expectedItem['id']]);
    }

    protected function assertDeleteById(int|string $id, string $login = null, bool $checkInCollection = false)
    {
        if ($checkInCollection) {
            $response = $this->all(['perPage' => 1000], $login);
            $ids = ArrayHelper::getColumn($response->getResult(), 'id');
        }

        $response = $this->deleteById($id, $login);
        $this->getRpcAssert($response)->assertIsResult();

        // check deleted entity
        $this->assertNotFoundById($id, $login);

        if ($checkInCollection && in_array($id, $ids)) {
            ArrayHelper::removeByValue($id, $ids);
            $response = $this->all(['perPage' => 1000], $login);
            $this->getRpcAssert($response)->assertCollectionItemsById($ids);
        }
    }

    protected function assertNotFoundById(int|string $id, string $login = null)
    {
        $response = $this->findOneById($id, $login);
        $this->getRpcAssert($response)->assertNotFound();
    }

    protected function assertItem(array $data, string $login = null)
    {
        $response = $this->findOneById($data['id'], $login);
        $this->getRpcAssert($response)->assertResult($data);
    }

    protected function assertAuthActions(array $arr)
    {
        foreach ($arr as $methodName => $isRequireAuth) {
            if (!is_null($isRequireAuth)) {
                $request = $this->createRequest();
                $request->setMethod($this->baseMethod() . '.' . $methodName);
                $request->setParams([]);
                $response = $this->sendRequestByEntity($request);
                if ($isRequireAuth) {
                    $this->getRpcAssert($response)->assertTrue(
                        $response->getError()['code'] == HttpStatusCodeEnum::UNAUTHORIZED,
                        'Unauthorized required method ' . $methodName
                    );
                } else {
                    $this->getRpcAssert($response)->assertTrue(
                        $response->getError()['code'] != HttpStatusCodeEnum::UNAUTHORIZED,
                        'authorized not required method ' . $methodName
                    );
                }
            }
        }
    }

    protected function assertCrudAuth(
        bool $all = null,
        bool $one = null,
        bool $create = null,
        bool $update = null,
        bool $delete = null
    ) {
        $arr = [
            $this->getMethod(CrudMethodEnum::METHOD_ALL) => $all,
            $this->getMethod(CrudMethodEnum::METHOD_ONE_BY_ID) => $one,
            $this->getMethod(CrudMethodEnum::METHOD_CREATE) => $create,
            $this->getMethod(CrudMethodEnum::METHOD_UPDATE) => $update,
            $this->getMethod(CrudMethodEnum::METHOD_CREATE) => $delete,
        ];
        $this->assertAuthActions($arr);
    }
}
