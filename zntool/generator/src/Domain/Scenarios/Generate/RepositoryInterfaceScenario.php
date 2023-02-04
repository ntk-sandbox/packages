<?php

namespace Untek\Tool\Generator\Domain\Scenarios\Generate;

use Untek\Domain\Repository\Interfaces\CrudRepositoryInterface;
use Untek\Domain\Repository\Interfaces\RepositoryInterface;
use Untek\Tool\Generator\Domain\Helpers\ClassHelper;

class RepositoryInterfaceScenario extends BaseInterfaceScenario
{

    public function typeName()
    {
        return 'RepositoryInterface';
    }

    public function classDir()
    {
        return 'Interfaces\\Repositories';
    }

    protected function createClass()
    {
        $fileGenerator = $this->getFileGenerator();
        $interfaceGenerator = $this->getClassGenerator();
        $interfaceGenerator->setName($this->getClassName());
        $fileGenerator->setNamespace($this->domainNamespace . '\\' . $this->classDir());

//        $fileGenerator = new FileGenerator();
//        $interfaceGenerator = new InterfaceGenerator;
//        $interfaceGenerator->setName($this->getInterfaceName());
        if ($this->buildDto->isCrudRepository) {
            $fileGenerator->setUse(CrudRepositoryInterface::class);
            $interfaceGenerator->setImplementedInterfaces(['CrudRepositoryInterface']);
        } else {
            $fileGenerator->setUse(RepositoryInterface::class);
            $interfaceGenerator->setImplementedInterfaces(['RepositoryInterface']);
        }
//        $fileGenerator->setNamespace($this->domainNamespace . '\\' . $this->interfaceDir());
//        $fileGenerator->setClass($interfaceGenerator);
        ClassHelper::generateFile($this->getFullClassName(), $fileGenerator->generate());
    }
}
