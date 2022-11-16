<?php

namespace ZnLib\Components\ShellRobot\Domain\Libs\App;

use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\Code\Helpers\DeprecateHelper;
use ZnLib\Components\ShellRobot\Domain\Factories\ShellFactory;

DeprecateHelper::hardThrow();

class ConfigProcessor
{

    private $config;

    public function __construct(array $config)
    {
        $this->setConfig($config);
    }

    public function get(string $key, $default = null)
    {
        $value = ArrayHelper::getValue($this->config, $key, $default);
        if (is_string($value)) {
            $value = ShellFactory::getVarProcessor()->process($value);
        }
        return $value;
    }

    /*public function all()
    {
        return $this->config;
    }*/

    private function setConfig(array $config): void
    {
        $this->config = $config;
    }
}
