<?php

namespace Untek\Tool\Generator\Commands;

use Symfony\Component\Console\Question\Question;
use Untek\Core\Instance\Helpers\ClassHelper;
use Untek\Core\Text\Helpers\Inflector;
use Untek\Framework\Console\Symfony4\Question\ChoiceQuestion;
use Untek\Sandbox\Sandbox\Bundle\Domain\Entities\BundleEntity;
use Untek\Sandbox\Sandbox\Bundle\Domain\Entities\DomainEntity;
use Untek\Sandbox\Sandbox\Bundle\Domain\Interfaces\Services\BundleServiceInterface;
use Untek\Tool\Generator\Domain\Dto\BuildDto;
use Untek\Tool\Generator\Domain\Interfaces\Services\DomainServiceInterface;
use Untek\Tool\Generator\Domain\Scenarios\Input\DomainNameInputScenario;
use Untek\Tool\Generator\Domain\Scenarios\Input\DomainNamespaceInputScenario;
use Untek\Tool\Generator\Domain\Scenarios\Input\DriverInputScenario;
use Untek\Tool\Generator\Domain\Scenarios\Input\EntityAttributesInputScenario;
use Untek\Tool\Generator\Domain\Scenarios\Input\IsCrudRepositoryInputScenario;
use Untek\Tool\Generator\Domain\Scenarios\Input\IsCrudServiceInputScenario;
use Untek\Tool\Generator\Domain\Scenarios\Input\NameInputScenario;
use Untek\Tool\Generator\Domain\Scenarios\Input\TypeInputScenario;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DomainCommand extends BaseGeneratorCommand
{

    protected static $defaultName = 'generator:domain';
    private $domainService;
    private $bundleService;

    public function __construct(DomainServiceInterface $domainService, BundleServiceInterface $bundleService)
    {
        parent::__construct(self::$defaultName);
        $this->domainService = $domainService;
        $this->bundleService = $bundleService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<fg=white># Domain generator</>');
        $buildDto = new BuildDto;
        $buildDto->typeArray = [
            'service',
            'repository',
            'entity',
            'filter',
            'form',
            'migration',
            'permissionEnum',
            'rpcController', // todo: CRUD, non CRUD select
//            'domain',
        ];
        $this->input($input, $output, $buildDto);
        $this->domainService->generate($buildDto);
        return 0;
    }

    private function input(InputInterface $input, OutputInterface $output, BuildDto $buildDto)
    {
        /*$buildDto->domainNamespace = 'App\\Domain';
        $buildDto->domainName = 'app';
        $buildDto->types = array_keys($buildDto->typeArray);
        $buildDto->name = 'qwerty';
        $buildDto->attributes = ['id', 'category_id', 'title', 'author', 'is_archive', 'status', 'size', 'created_at'];
        $buildDto->isCrudService = true;
        $buildDto->isCrudRepository = true;
        $buildDto->driver = [
            'eloquent',
            'file',
        ];
        return;*/


        $domainEntity = $this->selectDomain($input, $output);
        $buildDto->domainNamespace = $domainEntity->getNamespace();
            //dd($domainNamespace);

        //$this->runInputScenario(DomainNamespaceInputScenario::class, $input, $output, $buildDto);

//        $domainClass = $buildDto->domainNamespace . '\\Domain';
        $domainClass = $domainEntity->getClassName();

        if (class_exists($domainClass)) {
            $buildDto->domainName = $domainEntity->getName();
            $output->writeln('');
            $output->writeln("<fg=green>Domain founded ({$buildDto->domainName})</>");
        } else {
            $buildDto->domainName = $domainEntity->getName();
            $output->writeln('');
            $output->writeln("<fg=green>Domain founded ({$buildDto->domainName})</>");
        }
        if (empty($buildDto->domainName)) {
            $this->runInputScenario(DomainNameInputScenario::class, $input, $output, $buildDto);
        }

        $this->runInputScenario(TypeInputScenario::class, $input, $output, $buildDto);
        $this->runInputScenario(NameInputScenario::class, $input, $output, $buildDto);

        if (array_intersect(['entity', 'filter', 'form', 'migration'], $buildDto->types)) {
            $this->runInputScenario(EntityAttributesInputScenario::class, $input, $output, $buildDto);
        }

        if (in_array('service', $buildDto->types)) {
            $this->runInputScenario(IsCrudServiceInputScenario::class, $input, $output, $buildDto);
        }

        if (in_array('repository', $buildDto->types)) {
            $this->runInputScenario(DriverInputScenario::class, $input, $output, $buildDto);
            $this->runInputScenario(IsCrudRepositoryInputScenario::class, $input, $output, $buildDto);
        }
    }

    private function selectDomain(InputInterface $input, OutputInterface $output): DomainEntity
    {
        /** @var BundleEntity[] $bundleCollection */
        $bundleCollection = $this->bundleService->findAll();
        $domainCollection = [];
        $domainCollectionNamespaces = [];
        foreach ($bundleCollection as $bundleEntity) {

//            if ($bundleEntity->getDomain()) {
                //$domainNamespace = ClassHelper::getNamespace($bundleEntity->getDomain()->getClassName());
                $bundleNamespace = $bundleEntity->getNamespace();
                //$domainName = $bundleEntity->getDomain()->getName();
//                $title = "$domainName ($bundleNamespace)";
                $title = $bundleNamespace;
                $domainCollection[] = $title;
            if (! $bundleEntity->getDomain()) {
                $domainEntity = new DomainEntity();
                $domainEntity->setName($bundleEntity->getName());
                $domainEntity->setNamespace($bundleNamespace . '\\Domain');
                $domainEntity->setClassName($bundleNamespace . '\\Domain\\Domain');
                $bundleEntity->setDomain($domainEntity);
            }

            $domainCollectionNamespaces[$title] = $bundleEntity->getDomain();
//            }
            // dd($domainNamespace);
        }

        $domainCollection['c'] = '- Create new bundle -';

        $output->writeln('');
        $question = new ChoiceQuestion(
            'Select bundle',
            $domainCollection
        );
        $selectedIndex = $this->getHelper('question')->ask($input, $output, $question);

//        dd($selectedDomain);
        if($selectedIndex == 'c') {
            $question = new Question('Enter bundle namespace: ');
            $bundleNamespace = $this->getHelper('question')->ask($input, $output, $question);

            $domainEntity = new DomainEntity();
            $domainEntity->setName(Inflector::variablize(basename($bundleNamespace)));
            $domainEntity->setNamespace($bundleNamespace);
            $domainEntity->setClassName($bundleNamespace . '\\Domain');

            return $domainEntity;
            //dd($bundleNamespace);
        } else {
            $selectedBandleNamespace = $domainCollection[$selectedIndex];
            //dd($domainCollectionNamespaces[$selectedBandleNamespace]);
            return $domainCollectionNamespaces[$selectedBandleNamespace];
        }

//        return $domainCollectionNamespaces[$selectedDomain];
    }
}
