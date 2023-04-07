<?php

namespace Untek\Tool\Generator\Domain\Scenarios\Generate;

use Laminas\Code\Generator\ClassGenerator;
use Laminas\Code\Generator\FileGenerator;
use Laminas\Code\Generator\MethodGenerator;
use Untek\Core\Text\Helpers\Inflector;
use Untek\Component\FormatAdapter\StoreFile;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentRepository;
use Untek\Tool\Generator\Domain\Enums\TypeEnum;
use Untek\Tool\Generator\Domain\Helpers\ClassHelper;
use Untek\Tool\Generator\Domain\Helpers\LocationHelper;
use Untek\Tool\Package\Domain\Helpers\PackageHelper;

class RepositoryScenario extends BaseScenario
{

    public $driver;

    public function typeName()
    {
        return 'Repository';
    }

    public function classDir()
    {
        return 'Repositories';
    }

    /*protected function isMakeInterface(): bool
    {
        return true;
    }

    protected function createInterface()
    {

    }*/

    protected function createClass()
    {
        $repositoryInterfaceScenario = $this->createGenerator(RepositoryInterfaceScenario::class);
        $repositoryInterfaceScenario->run();

        foreach ($this->buildDto->driver as $driver) {
            $this->createOneClass($driver);
        }
    }

    /* public function getFullClassName(): string
     {
         return $this->classNamespace() . '\\' . $this->getClassName();
     }*/

    protected function createOneClass(string $driver)
    {
        $className = $this->getClassName();
        $driverDirName = Inflector::camelize($driver);
        $repoClassName = $driverDirName . '\\' . $className;
        $fileGenerator = new FileGenerator();
        $classGenerator = new ClassGenerator();
        $fileGenerator->setClass($classGenerator);
        $fileGenerator->setNamespace($this->classNamespace() . '\\' . $driverDirName);

        $parentClass = $this->parentClass($driver);
        if ($parentClass) {
            $fileGenerator->setUse($parentClass);
            $classGenerator->setExtendedClass(basename($parentClass));
        }

        $methodGenerator = $this->generateTableNameMethod();
        $classGenerator->addMethodFromGenerator($methodGenerator);

        $entityFullClassName = $this->domainNamespace . LocationHelper::fullClassName($this->name, TypeEnum::ENTITY);
        $entityPureClassName = \Untek\Core\Instance\Helpers\ClassHelper::getClassOfClassName($entityFullClassName);
        $fileGenerator->setUse($entityFullClassName);

        $methodGenerator = $this->generateGetEntityClassMethod($entityPureClassName);
        $classGenerator->addMethodFromGenerator($methodGenerator);

        $classGenerator->setName($className);
        if ($this->isMakeInterface()) {
            $classGenerator->setImplementedInterfaces([$this->getInterfaceName()]);
            $fileGenerator->setUse($this->getInterfaceFullName());
        }


        $phpCode = $this->generateFileCode($fileGenerator);

        ClassHelper::generateFile($fileGenerator->getNamespace() . '\\' . $this->getClassName(), $phpCode);

        $this->updateContainerConfig($fileGenerator);
    }

    private function updateContainerConfig(FileGenerator $fileGenerator)
    {
        $fullClassName = $this->getFullClassName();
        $className = $this->getClassName();
        $containerFileName = PackageHelper::pathByNamespace($this->domainNamespace) . '/config/container.php';
        $storeFile = new StoreFile($containerFileName);
        $containerConfig = $storeFile->load();
        $containerConfig['singletons'][$this->getInterfaceFullName()] = $fileGenerator->getNamespace() . '\\' . $className;
        $storeFile->save($containerConfig);
    }

    private function generateGetEntityClassMethod(string $entityPureClassName): MethodGenerator
    {
        $tableName = "{$this->buildDto->domainName}_{$this->buildDto->name}";
        $methodBody = "return {$entityPureClassName}::class;";
        $methodGenerator = new MethodGenerator;
        $methodGenerator->setName('getEntityClass');
        $methodGenerator->setBody($methodBody);
        $methodGenerator->setReturnType('string');
        return $methodGenerator;
    }

    private function generateTableNameMethod(): MethodGenerator
    {
        $tableName = "{$this->buildDto->domainName}_{$this->buildDto->name}";
        $tableName = Inflector::underscore($tableName);
        $methodBody = "return '{$tableName}';";
        $methodGenerator = new MethodGenerator;
        $methodGenerator->setName('tableName');
        $methodGenerator->setBody($methodBody);
        $methodGenerator->setReturnType('string');
        return $methodGenerator;
    }

    private function parentClass($driver)
    {
        $className = '';
        if ('eloquent' == $driver) {
            if ($this->buildDto->isCrudRepository) {
                $className = BaseEloquentCrudRepository::class;
            } else {
                $className = BaseEloquentRepository::class;
            }
        } else {
            //$className = 'Untek\Model\Shared\Base\BaseRepository';
        }
        return $className;
    }

}
