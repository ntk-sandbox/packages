<?php

namespace ZnBundle\Messenger\Rpc\Controllers;

use ZnBundle\Messenger\Domain\Filters\MessageFilter;
use ZnBundle\Messenger\Domain\Forms\MessageForm;
use ZnBundle\Messenger\Domain\Interfaces\Services\MessageServiceInterface;
use ZnBundle\Messenger\Domain\Interfaces\Services\TournamentServiceInterface;
use ZnCore\DotEnv\Domain\Libs\DotEnv;
use ZnDomain\Validator\Helpers\ValidationHelper;
use ZnDomain\Query\Entities\Query;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Rpc\Base\BaseCrudRpcController;

class MessageController extends BaseCrudRpcController
{

    protected $filterModel = MessageFilter::class;

    public function __construct(MessageServiceInterface $service)
    {
        $this->service = $service;
    }

    public function all(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $query = new Query();
        $query->orderBy(['id'=>SORT_DESC]);
        $this->forgeQueryByRequest($query, $requestEntity);
        $dp = $this->service->getDataProvider($query);
        $perPageMax = $this->pageSizeMax ?? $_ENV['PAGE_SIZE_MAX'] ?? 50;
        $dp->getEntity()->setMaxPageSize($perPageMax);

        if ($this->filterModel) {
            $filterModel = $this->forgeFilterModel($requestEntity);
            $query->setFilterModel($filterModel);
            $dp->setFilterModel($filterModel);
        }
        $dp->getEntity()->setCollection($dp->getCollection()->reverse());
        return $this->serializeResult($dp);
    }

    public function send(RpcRequestEntity $requestEntity): RpcResponseEntity {
        $chatId = $requestEntity->getParamItem('chatId');
        $message = $requestEntity->getParamItem('message');
        $form = new MessageForm();
        $form->setChatId($chatId);
        $form->setText($message);
        $this->service->sendMessageByForm($form);
        return new RpcResponseEntity();
    }
}
