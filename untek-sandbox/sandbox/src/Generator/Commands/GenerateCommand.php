<?php

namespace Untek\Sandbox\Sandbox\Generator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Core\Instance\Helpers\ClassHelper;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\Collection\Libs\Collection;
use Untek\Database\Base\Domain\Entities\TableEntity;
use Untek\Framework\Console\Symfony4\Question\ChoiceQuestion;
use Untek\Sandbox\Sandbox\Bundle\Domain\Entities\DomainEntity;
use Untek\Sandbox\Sandbox\Bundle\Domain\Interfaces\Services\BundleServiceInterface;
use Untek\Sandbox\Sandbox\Generator\Domain\Libs\Input\SelectClassesInput;
use Untek\Sandbox\Sandbox\Generator\Domain\Libs\Input\SelectDomainInput;
use Untek\Sandbox\Sandbox\Generator\Domain\Libs\Input\SelectEntityInput;
use Untek\Sandbox\Sandbox\Generator\Domain\Libs\TableAdapters\BaseAdapter;
use Untek\Sandbox\Sandbox\Generator\Domain\Libs\TableAdapters\EntityAdapter;
use Untek\Sandbox\Sandbox\Generator\Domain\Libs\TableAdapters\RepositoryAdapter;
use Untek\Sandbox\Sandbox\Generator\Domain\Libs\TableAdapters\ServiceAdapter;
use Untek\Sandbox\Sandbox\Generator\Domain\Services\GeneratorService;

class GenerateCommand extends Command
{

    protected static $defaultName = 'generator:generate';

    private $generatorService;
    private $bundleService;

    public function __construct(
        GeneratorService $generatorService,
        BundleServiceInterface $bundleService
    )
    {
        parent::__construct(self::$defaultName);
        $this->generatorService = $generatorService;
        $this->bundleService = $bundleService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<fg=white># Generator</>');

        $params = [
            'input' => $input,
            'output' => $output,
            'command' => $this,
        ];

        $inputDefinitions = [
            SelectDomainInput::class,
            SelectEntityInput::class,
            SelectClassesInput::class,
        ];

        foreach ($inputDefinitions as $inputDefinition) {
            $inputInstance = ClassHelper::createObject($inputDefinition, $params);
            $inputInstance->run();
            $params = ArrayHelper::merge($params, $inputInstance->getResult());
        }


        /*$inputInstance = ClassHelper::createObject(SelectDomainInput::class, $params);
        $inputInstance->run();
        $params = ArrayHelper::merge($params, $inputInstance->getResult());*/
        // $domainEntity = $params['domainEntity'];


//dd($params);
        //$params['domainEntity'] = $domainEntity;

        //$domainEntity = $this->selectDomain($input, $output);
        //$selectedEntities = $this->selectEntity($input, $output, $domainEntity);

//        $container = ContainerHelper::getContainer();
//        $selectEntityInput = $container->make(SelectEntityInput::class, $params);
//        $selectClassesInput = $container->make(SelectClassesInput::class, $params);

        /*$selectEntityInput = ClassHelper::createObject(SelectEntityInput::class, $params);
        $selectEntityInput->run();
        $params = ArrayHelper::merge($params, $selectEntityInput->getResult());

        $selectClassesInput = ClassHelper::createObject(SelectClassesInput::class, $params);
        $selectClassesInput->run();
        $params = ArrayHelper::merge($params, $selectClassesInput->getResult());*/

        //$tableList = $this->generatorService->allTables();
        //$selectClassesInput = new SelectClassesInput($input, $output, $this);
//        $selectedClasses = $this->selectClasses($input, $output, $domainEntity);
        //dd(array_keys($params));


        //dd($params['domainEntity']);

        /** @var TableEntity[] $structure */
        $structure = $this->getStructureTables($params['domainEntity'], $params['entities']);

        $classCollection = new Collection();

        $adapterDefinitions = [
            'entity' => new EntityAdapter(),
            'service' => new ServiceAdapter(),
            'repository' => new RepositoryAdapter(),
        ];

        foreach ($structure as $tableEntity) {
            foreach ($params['classes'] as $adapterName) {
                if (in_array($adapterName, $params['classes'])) {
                    /** @var BaseAdapter $adapterInstance */
                    $adapterInstance = ClassHelper::createObject($adapterDefinitions[$adapterName]);
                    $entityEntity = $adapterInstance->run($params['domainEntity'], $tableEntity);
                    $classCollection->add($entityEntity);
                }
            }

            /*if(in_array('entity', $params['classes'])) {
                $adapter = new EntityAdapter();
                $entityEntity = $adapter->run($domainEntity, $tableEntity);
//                $entityEntity = TableMapperHelper::createEntityFromTable($domainEntity, $tableEntity);
                $classCollection->add($entityEntity);
            }
            if(in_array('service', $params['classes'])) {
                $adapter = new ServiceAdapter();
                $serviceEntity = $adapter->run($domainEntity, $tableEntity);
                //$serviceEntity = TableMapperHelper::createServiceFromTable($domainEntity, $tableEntity);
                $classCollection->add($serviceEntity);
            }
            if(in_array('repository', $params['classes'])) {
                $adapter = new RepositoryAdapter();
                $repositoryEntity = $adapter->run($domainEntity, $tableEntity);
                //$repositoryEntity = TableMapperHelper::createRepositoryFromTable($domainEntity, $tableEntity);
                $classCollection->add($repositoryEntity);
            }*/
        }

        dd($classCollection);

        if (empty($tableList)) {
            $output->writeln('');
            $output->writeln('<fg=magenta>No tables in database!</>');
            $output->writeln('');
            return 0;
        }

        $output->writeln('');
        $question = new ChoiceQuestion(
            'Select tables for export',
            $tableList,
            'a'
        );
        $question->setMultiselect(true);
        $selectedTables = $this->getHelper('question')->ask($input, $output, $question);
        $structure = $this->generatorService->getStructure($selectedTables);

        dd($structure);
        return 0;
    }

    private function getStructureTables(DomainEntity $domainEntity, array $selectedEntities): Enumerable
    {
        $selectedTables = [];
        foreach ($selectedEntities as $entityName) {
            $selectedTables[] = $domainEntity->getName() . '_' . $entityName;
        }
        $structure = $this->generatorService->getStructure($selectedTables);
        return $structure;
    }

//    private function selectDomain(InputInterface $input, OutputInterface $output): DomainEntity
//    {
//        /** @var BundleEntity[] $bundleCollection */
//        $bundleCollection = $this->bundleService->findAll();
//        $domainCollection = [];
//        $domainCollectionNamespaces = [];
//        foreach ($bundleCollection as $bundleEntity) {
//            if ($bundleEntity->getDomain()) {
////                $domainNamespace = ClassHelper::getNamespace($bundleEntity->getDomain()->getClassName());
//                $domainNamespace = $bundleEntity->getNamespace();
//                $domainName = $bundleEntity->getDomain()->getName();
//                $title = "$domainName ($domainNamespace)";
//                $domainCollection[] = $title;
//                $domainCollectionNamespaces[$title] = $bundleEntity->getDomain();
//            }
//            // dd($domainNamespace);
//        }
//
//        $output->writeln('');
//        $question = new ChoiceQuestion(
//            'Select domain',
//            $domainCollection
//        );
//        $selectedDomain = $this->getHelper('question')->ask($input, $output, $question);
//        return $domainCollectionNamespaces[$selectedDomain];
//    }
}
