<?php

namespace ZnLib\Components\ShellRobot\Domain\Tasks\Common;

use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;
use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnLib\Components\ShellRobot\Domain\Libs\App\TaskProcessor;

class ChainTask extends BaseShell implements TaskInterface
{

    public $tasks = [];

    public function run()
    {
        TaskProcessor::runTaskList($this->tasks);
    }
}
