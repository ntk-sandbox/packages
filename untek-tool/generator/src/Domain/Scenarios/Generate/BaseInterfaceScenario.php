<?php

namespace Untek\Tool\Generator\Domain\Scenarios\Generate;

use Laminas\Code\Generator\InterfaceGenerator;

abstract class BaseInterfaceScenario extends BaseScenario
{

    public function __construct()
    {
        $this->setClassGenerator(new InterfaceGenerator());
    }
}
