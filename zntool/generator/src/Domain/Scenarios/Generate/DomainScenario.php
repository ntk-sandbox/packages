<?php

namespace Untek\Tool\Generator\Domain\Scenarios\Generate;

use Untek\Tool\Generator\Domain\Helpers\ClassHelper;
use Untek\Domain\Domain\Interfaces\DomainInterface;
use Laminas\Code\Generator\ClassGenerator;
use Laminas\Code\Generator\FileGenerator;
use Laminas\Code\Generator\MethodGenerator;

class DomainScenario extends BaseScenario
{

    public function typeName()
    {
        return 'Domain';
    }

    public function classDir()
    {
        return '';
    }

    public function classNamespace(): string
    {
        return ;
    }

    protected function createClass()
    {
        $fileGenerator = $this->getFileGenerator();
        $classGenerator = $this->getClassGenerator();
        $classGenerator->setName('Domain');
        $this->addInterface(DomainInterface::class);
//        $classGenerator->setImplementedInterfaces(['DomainInterface']);
        $classGenerator->addMethods([
            MethodGenerator::fromArray([
                'name' => 'getName',
                'body' => "return '{$this->buildDto->domainName}';",
            ]),
        ]);
//        $fileGenerator->setClass($classGenerator);
//        $fileGenerator->setUse(DomainInterface::class);
        $fileGenerator->setNamespace($this->classNamespace());
        ClassHelper::generateFile($fileGenerator->getNamespace() . '\\' . 'Domain', $fileGenerator->generate());
    }
}
