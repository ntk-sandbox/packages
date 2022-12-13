<?php

namespace ZnLib\Components\ShellRobot\Domain\Repositories\File;

use ZnCore\Arr\Helpers\ArrayHelper;
use ZnLib\Components\ShellRobot\Domain\Interfaces\Repositories\ConfigRepositoryInterface;

class ConfigRepository implements ConfigRepositoryInterface
{

    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function get(string $key, $default = null)
    {
        $value = ArrayHelper::getValue($this->config, $key, $default);
        return $value;
    }
}
