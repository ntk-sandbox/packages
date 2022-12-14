<?php

namespace ZnFramework\Rpc\Domain\Base;

use ZnCore\Env\Helpers\EnvHelper;
use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnDomain\Validator\Helpers\ErrorCollectionHelper;
use ZnDomain\Domain\Interfaces\GetEntityClassInterface;
use ZnDomain\Domain\Traits\DispatchEventTrait;
use ZnDomain\Domain\Traits\ForgeQueryTrait;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnDomain\Repository\Base\BaseRepository;
use ZnDomain\Repository\Traits\RepositoryMapperTrait;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Domain\Enums\HttpHeaderEnum;
use ZnFramework\Rpc\Domain\Enums\RpcErrorCodeEnum;
use ZnFramework\Rpc\Domain\Enums\RpcVersionEnum;
use ZnFramework\Rpc\Domain\Facades\RpcClientFacade;
use ZnFramework\Rpc\Domain\Forms\BaseRpcAuthForm;
use ZnFramework\Rpc\Domain\Forms\RpcAuthGuestForm;
use ZnFramework\Rpc\Domain\Libs\RpcAuthProvider;
use ZnFramework\Rpc\Domain\Libs\RpcProvider;

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
            (new RpcClientFacade(EnvHelper::getAppEnv()))
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
