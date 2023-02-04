<?php

namespace Untek\Tool\Generator\Domain\Scenarios\Generate;

use Laminas\Code\Generator\ClassGenerator;
use Laminas\Code\Generator\DocBlock\Tag\MethodTag;
use Laminas\Code\Generator\DocBlockGenerator;
use Laminas\Code\Generator\FileGenerator;
use Laminas\Code\Generator\InterfaceGenerator;
use Laminas\Code\Generator\MethodGenerator;
use Laminas\Code\Generator\ParameterGenerator;
use Laminas\Code\Generator\PropertyGenerator;
use Laminas\Code\Reflection\DocBlockReflection;
use Untek\Core\Text\Helpers\Inflector;
use Untek\Lib\Components\Store\StoreFile;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Service\Interfaces\CrudServiceInterface;
use Untek\User\Notify\Domain\Interfaces\Repositories\TransportRepositoryInterface;
use Untek\Tool\Generator\Domain\Enums\TypeEnum;
use Untek\Tool\Generator\Domain\Helpers\ClassHelper;
use Untek\Tool\Generator\Domain\Helpers\LocationHelper;
use Untek\Tool\Package\Domain\Helpers\PackageHelper;

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
