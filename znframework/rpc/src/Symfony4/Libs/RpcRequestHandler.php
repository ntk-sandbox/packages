<?php

namespace ZnFramework\Rpc\Symfony4\Libs;

use ZnFramework\Rpc\Domain\Entities\RpcRequestCollection;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseCollection;
use ZnFramework\Rpc\Domain\Enums\HttpHeaderEnum;
use ZnFramework\Rpc\Domain\Enums\RpcBatchModeEnum;
use ZnFramework\Rpc\Domain\Enums\RpcErrorCodeEnum;
use ZnFramework\Rpc\Domain\Helpers\ErrorHelper;
use ZnFramework\Rpc\Domain\Helpers\RequestHelper;
use ZnFramework\Rpc\Domain\Interfaces\Services\ProcedureServiceInterface;
use ZnFramework\Rpc\Domain\Libs\ResponseFormatter;
use ZnFramework\Rpc\Domain\Libs\RpcJsonResponse;

class RpcRequestHandler
{

    protected $procedureService;
    protected $responseFormatter;
    protected $rpcJsonResponse;

    public function __construct(
        ResponseFormatter $responseFormatter,
        RpcJsonResponse $rpcJsonResponse,
        ProcedureServiceInterface $procedureService
    )
    {
        $this->responseFormatter = $responseFormatter;
        $this->rpcJsonResponse = $rpcJsonResponse;
        $this->procedureService = $procedureService;
    }

    public function handleJsonData(string $jsonData)
    {
        $requestData = json_decode($jsonData, true);
        $jsonErrorCode = json_last_error();
        if ($jsonErrorCode) {
            $message = $this->jsonErrorCodeToMessage($jsonErrorCode);
            $responseCollection = $this->createErrorResponseByMessage($message);
            $batchMode = RpcBatchModeEnum::SINGLE;
        } elseif (empty($requestData)) {
            $message = "Invalid request. Empty request!";
            $responseCollection = $this->createErrorResponseByMessage($message);
            $batchMode = RpcBatchModeEnum::SINGLE;
        } else {
            //$this->logger->info('request', $requestData ?: []);
//            $controllerEvent = new ControllerEvent($controllerInstance, $actionName, $request);
//            $this->getEventDispatcher()->dispatch($controllerEvent, ControllerEventEnum::BEFORE_ACTION);

            $isBatchRequest = RequestHelper::isBatchRequest($requestData);
            $batchMode = $isBatchRequest ? RpcBatchModeEnum::BATCH : RpcBatchModeEnum::SINGLE;
            $requestCollection = RequestHelper::createRequestCollection($requestData);
            $responseCollection = $this->handleData($requestCollection);
        }
        $responseData = $this->rpcJsonResponse->encode($responseCollection, $batchMode);
        return $responseData;
    }

    private function handleData(RpcRequestCollection $requestCollection): RpcResponseCollection
    {
        $responseCollection = new RpcResponseCollection();
        foreach ($requestCollection->getCollection() as $requestEntity) {
            /** @var RpcRequestEntity $requestEntity */
            $requestEntity->addMeta(HttpHeaderEnum::IP, $_SERVER['REMOTE_ADDR']);
            $responseEntity = $this->procedureService->callOneProcedure($requestEntity);
            $responseCollection->add($responseEntity);
        }
        return $responseCollection;
    }

    private function jsonErrorCodeToMessage(int $jsonErrorCode): string
    {
        $errorDescription = ErrorHelper::descriptionFromJsonErrorCode($jsonErrorCode);
        $message = "Invalid request. Parse JSON error! {$errorDescription}";
        return $message;
    }

    private function createErrorResponseByMessage(string $message): RpcResponseCollection
    {
        $responseEntity = $this->responseFormatter->forgeErrorResponse(RpcErrorCodeEnum::SERVER_ERROR_INVALID_REQUEST, $message);
        $responseCollection = new RpcResponseCollection();
        $responseCollection->add($responseEntity);
        return $responseCollection;
    }
}
