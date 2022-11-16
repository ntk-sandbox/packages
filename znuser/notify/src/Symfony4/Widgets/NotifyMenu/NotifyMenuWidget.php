<?php

namespace ZnUser\Notify\Symfony4\Widgets\NotifyMenu;

use ZnUser\Notify\Domain\Enums\NotifyStatusEnum;
use ZnUser\Notify\Domain\Interfaces\Services\MyHistoryServiceInterface;
use ZnDomain\Query\Entities\Where;
use ZnDomain\Query\Entities\Query;
use ZnLib\Web\Widget\Base\BaseWidget2;

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
