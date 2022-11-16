<?php

namespace ZnSandbox\Sandbox\Generator\Domain\Libs\Input;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ZnCore\Collection\Helpers\CollectionHelper;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnFramework\Console\Symfony4\Question\ChoiceQuestion;
use ZnSandbox\Sandbox\Bundle\Domain\Entities\DomainEntity;
use ZnSandbox\Sandbox\Generator\Domain\Helpers\TableMapperHelper;
use ZnDatabase\Base\Domain\Repositories\Eloquent\SchemaRepository;

class SelectEntityInput extends BaseInput
{

    private $domainEntity;
    private $schemaRepository;

    public function __construct(
        SchemaRepository $schemaRepository
    )
    {
        $this->schemaRepository = $schemaRepository;
    }

    public function getDomainEntity(): DomainEntity
    {
        return $this->domainEntity;
    }

    public function setDomainEntity(DomainEntity $domainEntity): void
    {
        $this->domainEntity = $domainEntity;
    }

    public function run(): array
    {
        $tableCollection = $this->schemaRepository->allTables();
        $tableList = CollectionHelper::getColumn($tableCollection, 'name');
        $entityNames = [];
        foreach ($tableList as $tableName) {
            $bundleName = TableMapperHelper::extractDomainNameFromTable($tableName);
            if ($this->domainEntity->getName() == $bundleName) {
                $entityNames[] = TableMapperHelper::extractEntityNameFromTable($tableName);
            }
        }

        $question = new ChoiceQuestion(
            'Select entity',
            $entityNames,
            'a'
        );
        $question->setMultiselect(true);
        $selectedEntities = $this->getCommand()->getHelper('question')->ask($this->getInput(), $this->getOutput(), $question);
        $this->addResultParam('entities', $selectedEntities);
        return $selectedEntities;
//        dd($entityNames);
    }
}
