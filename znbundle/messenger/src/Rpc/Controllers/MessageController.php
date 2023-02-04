<?php

namespace Untek\Bundle\Messenger\Rpc\Controllers;

use Untek\Bundle\Messenger\Domain\Filters\MessageFilter;
use Untek\Bundle\Messenger\Domain\Forms\MessageForm;
use Untek\Bundle\Messenger\Domain\Interfaces\Services\MessageServiceInterface;
use Untek\Bundle\Messenger\Domain\Interfaces\Services\TournamentServiceInterface;
use Untek\Core\DotEnv\Domain\Libs\DotEnv;
use Untek\Domain\Validator\Helpers\ValidationHelper;
use Untek\Domain\Query\Entities\Query;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Framework\Rpc\Rpc\Base\BaseCrudRpcController;

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
        $perPageMax = $this->pageSizeMax ?? (getenv('PAGE_SIZE_MAX') ?: 50);
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
