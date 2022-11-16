<?php

namespace ZnTool\Generator\Domain\Scenarios\Generate;

use Laminas\Code\Generator\InterfaceGenerator;

abstract class BaseInterfaceScenario extends BaseScenario
{

    public function __construct()
    {
        $this->setClassGenerator(new InterfaceGenerator());
    }
}
