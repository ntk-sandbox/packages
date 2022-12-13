<?php

namespace ZnFramework\Telegram\Domain\Actions;

use ZnFramework\Telegram\Domain\Entities\RequestEntity;
use ZnFramework\Telegram\Domain\Base\BaseAction;

class GroupAction extends BaseAction
{

    /** @var array | BaseAction[] */
    private $actions;

    public function __construct(array $actions)
    {
        parent::__construct();
        $this->actions = $actions;
    }

    public function run(RequestEntity $requestEntity)
    {
        foreach ($this->actions as $actionInstance) {
            $actionInstance->run($requestEntity);
        }
    }

}
