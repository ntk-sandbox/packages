<?php

namespace Untek\Tool\Generator\Domain\Services;

use Untek\Core\Text\Helpers\Inflector;
use Untek\Core\Instance\Helpers\ClassHelper;
use Untek\Tool\Generator\Domain\Dto\BuildDto;
use Untek\Tool\Generator\Domain\Interfaces\Services\ModuleServiceInterface;
use Untek\Tool\Generator\Domain\Scenarios\Generate\BaseScenario;

class ModuleService implements ModuleServiceInterface
{

    public function generate(BuildDto $buildDto)
    {
        $type = Inflector::classify($buildDto->typeModule);
        $scenarioInstance = $this->createScenarioByTypeName($type);
        $scenarioParams = [
            'buildDto' => $buildDto,
            'moduleNamespace' => $buildDto->moduleNamespace,
        ];
        ClassHelper::configure($scenarioInstance, $scenarioParams);
        $scenarioInstance->init();
        $scenarioInstance->run();
    }

    private function createScenarioByTypeName($type): BaseScenario
    {
        $scenarioClass = 'Untek\\Tool\\Generator\\Domain\Scenarios\\Generate\\' . $type . 'Scenario';
        /** @var BaseScenario $scenarioInstance */
        $scenarioInstance = new $scenarioClass;
        return $scenarioInstance;
    }

}
