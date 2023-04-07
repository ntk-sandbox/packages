<?php

namespace Untek\User\Notify\Symfony4\Widgets\NotifyMenu;

use Untek\User\Notify\Domain\Enums\NotifyStatusEnum;
use Untek\User\Notify\Domain\Interfaces\Services\MyHistoryServiceInterface;
use Untek\Model\Query\Entities\Where;
use Untek\Model\Query\Entities\Query;
use Untek\Lib\Web\Widget\Base\BaseWidget2;

class NotifyMenuWidget extends BaseWidget2
{

    public $myHistoryService;

    public function __construct(MyHistoryServiceInterface $myHistoryService, $config = [])
    {
        $this->myHistoryService = $myHistoryService;
    }

    public function run(): string
    {
        $query = new Query();
        $query->whereNew(new Where('status_id', NotifyStatusEnum::NEW));
        $dataProvider = $this->myHistoryService->getDataProvider($query);
        return $this->render('index', [
            'countMyHistory' => $dataProvider->getTotalCount(),
            'dataProvider' => $dataProvider,
        ]);
    }
}
