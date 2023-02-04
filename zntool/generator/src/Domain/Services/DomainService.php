<?php

namespace Untek\Tool\Generator\Domain\Services;

use Untek\Core\Text\Helpers\Inflector;
use Untek\Core\Instance\Helpers\ClassHelper;
use Untek\Tool\Generator\Domain\Dto\BuildDto;
use Untek\Tool\Generator\Domain\Interfaces\Services\DomainServiceInterface;
use Untek\Tool\Generator\Domain\Scenarios\Generate\BaseScenario;

class DomainService implements DomainServiceInterface
{

    public function generate(BuildDto $buildDto)
    {
        foreach ($buildDto->types as $typeName) {
            $type = $typeName;
            $type = Inflector::classify($type);
            $scenarioInstance = $this->createScenarioByTypeName($type);
            $scenarioParams = [
                'name' => $buildDto->name,
                'driver' => $buildDto->driver,
                'buildDto' => $buildDto,
                'domainNamespace' => $buildDto->domainNamespace,
            ];
            ClassHelper::configure($scenarioInstance, $scenarioParams);
            $scenarioInstance->init();
            $scenarioInstance->run();
        }
    }

    private function createScenarioByTypeName($type): BaseScenario
    {
        $scenarioClass = 'Untek\\Tool\\Generator\\Domain\Scenarios\\Generate\\' . $type . 'Scenario';
        /** @var BaseScenario $scenarioInstance */
        $scenarioInstance = new $scenarioClass;
        return $scenarioInstance;
    }
}
