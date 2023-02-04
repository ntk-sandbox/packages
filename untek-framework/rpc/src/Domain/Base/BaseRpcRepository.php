<?php

namespace Untek\Framework\Rpc\Domain\Base;

use Untek\Core\Env\Helpers\EnvHelper;
use Untek\Domain\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Domain\Validator\Helpers\ErrorCollectionHelper;
use Untek\Domain\Domain\Interfaces\GetEntityClassInterface;
use Untek\Domain\Domain\Traits\DispatchEventTrait;
use Untek\Domain\Domain\Traits\ForgeQueryTrait;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\Domain\Repository\Base\BaseRepository;
use Untek\Domain\Repository\Traits\RepositoryMapperTrait;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Framework\Rpc\Domain\Enums\HttpHeaderEnum;
use Untek\Framework\Rpc\Domain\Enums\RpcErrorCodeEnum;
use Untek\Framework\Rpc\Domain\Enums\RpcVersionEnum;
use Untek\Framework\Rpc\Domain\Facades\RpcClientFacade;
use Untek\Framework\Rpc\Domain\Forms\BaseRpcAuthForm;
use Untek\Framework\Rpc\Domain\Forms\RpcAuthGuestForm;
use Untek\Framework\Rpc\Domain\Libs\RpcAuthProvider;
use Untek\Framework\Rpc\Domain\Libs\RpcProvider;

abstract class BaseRpcRepository extends BaseRepository implements GetEntityClassInterface
{

    use RepositoryMapperTrait;
    use DispatchEventTrait;
    use ForgeQueryTrait;

    private $cache = [];

    abstract public function baseUrl(): string;

    public function getRpcProvider(): RpcProvider
    {
        $baseUrl = $this->baseUrl();
        $rpcProvider =
            (new RpcClientFacade(getenv('APP_ENV')))
                ->createRpcProvider($baseUrl);
        $authProvider = new RpcAuthProvider($rpcProvider);
        $rpcProvider->setAuthProvider($authProvider);
        return $rpcProvider;
    }

    protected function createRequest(string $methodName = null): RpcRequestEntity
    {
        $requestEntity = new RpcRequestEntity();
        $requestEntity->setJsonrpc(RpcVersionEnum::V2_0);
        $requestEntity->setMetaItem(HttpHeaderEnum::VERSION, 1);
        $methodName = $this->prepareMethodName($methodName);
        if ($methodName) {
            $requestEntity->setMethod($methodName);
        }
        return $requestEntity;
    }

    protected function prepareMethodName(string $methodName = null): string
    {
        $result = '';
        if ($this->methodPrefix()) {
            $result .= $this->methodPrefix();
        }
        if ($methodName) {
            $result .= $methodName;
        }
        return $result;
    }

    public function authBy(): BaseRpcAuthForm
    {
        return new RpcAuthGuestForm();
    }

    private function getRequestHash(RpcRequestEntity $requestEntity): string
    {
        $requestArray = EntityHelper::toArray($requestEntity);
        unset($requestArray['id']);
        unset($requestArray['jsonrpc']);
        $requestHashScope = json_encode($requestArray);
        $requestHash = hash('sha1', $requestHashScope);
        return $requestHash;
    }

    protected function sendRequestByEntity(RpcRequestEntity $requestEntity, BaseRpcAuthForm $authForm = null): RpcResponseEntity
    {
        $requestHash = $this->getRequestHash($requestEntity);
        $responseEntity = $this->cache[$requestHash] ?? null;
        if (!$responseEntity || EnvHelper::isTest()) {
            $responseEntity = $this->sendRequest($requestEntity, $authForm);
            $this->cache[$requestHash] = $responseEntity;
        }
        if ($responseEntity->isError()) {
            $this->handleError($responseEntity);
        }
        return $responseEntity;
    }

    protected function sendRequest(RpcRequestEntity $requestEntity, BaseRpcAuthForm $authForm = null): RpcResponseEntity
    {
        $provider = $this->getRpcProvider();
        $authForm = $authForm ?: $this->authBy();
        /*if (!$authForm instanceof RpcAuthGuestForm) {
            $provider->authByForm($authForm);
        }*/
        $responseEntity = $provider->sendRequestByEntity($requestEntity, $authForm);
        return $responseEntity;
    }

    protected function handleError(RpcResponseEntity $rpcResponseEntity)
    {
        $errorCode = $rpcResponseEntity->getError()['code'];
        if ($errorCode == RpcErrorCodeEnum::SERVER_ERROR_INVALID_PARAMS) {
            $errors = $rpcResponseEntity->getError()['data'];
            $errorCollection = ErrorCollectionHelper::itemArrayToCollection($errors);
            throw new UnprocessibleEntityException($errorCollection);
        }

        if ($errorCode == 404) {
            throw new NotFoundException();
        }
    }
}
