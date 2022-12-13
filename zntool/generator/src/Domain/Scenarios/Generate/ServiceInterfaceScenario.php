<?php

namespace ZnTool\Generator\Domain\Scenarios\Generate;

use Laminas\Code\Generator\ClassGenerator;
use Laminas\Code\Generator\DocBlock\Tag\MethodTag;
use Laminas\Code\Generator\DocBlockGenerator;
use Laminas\Code\Generator\FileGenerator;
use Laminas\Code\Generator\InterfaceGenerator;
use Laminas\Code\Generator\MethodGenerator;
use Laminas\Code\Generator\ParameterGenerator;
use Laminas\Code\Generator\PropertyGenerator;
use Laminas\Code\Reflection\DocBlockReflection;
use ZnCore\Text\Helpers\Inflector;
use ZnLib\Components\Store\StoreFile;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Service\Interfaces\CrudServiceInterface;
use ZnUser\Notify\Domain\Interfaces\Repositories\TransportRepositoryInterface;
use ZnTool\Generator\Domain\Enums\TypeEnum;
use ZnTool\Generator\Domain\Helpers\ClassHelper;
use ZnTool\Generator\Domain\Helpers\LocationHelper;
use ZnTool\Package\Domain\Helpers\PackageHelper;

class ServiceInterfaceScenario extends BaseInterfaceScenario
{

    public function typeName()
    {
        return 'ServiceInterface';
    }

    public function classDir()
    {
        return 'Interfaces\\Services';
    }

    protected function createClass()
    {
        $fileGenerator = $this->getFileGenerator();
        $interfaceGenerator = $this->getClassGenerator();
        $interfaceGenerator->setName($this->getClassName());
        if ($this->buildDto->isCrudService) {
            $fileGenerator->setUse(CrudServiceInterface::class);
            $interfaceGenerator->setImplementedInterfaces(['CrudServiceInterface']);
        }
//        $fileGenerator->setNamespace($this->classNamespace());
        $fileGenerator->setNamespace($this->domainNamespace . '\\' . $this->classDir());
//        $fileGenerator->setClass($interfaceGenerator);
        ClassHelper::generateFile($this->getFullClassName(), $fileGenerator->generate());
    }
}
