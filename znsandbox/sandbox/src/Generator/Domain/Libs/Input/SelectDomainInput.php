<?php

namespace ZnSandbox\Sandbox\Generator\Domain\Libs\Input;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnFramework\Console\Symfony4\Question\ChoiceQuestion;
use ZnSandbox\Sandbox\Bundle\Domain\Entities\BundleEntity;
use ZnSandbox\Sandbox\Bundle\Domain\Entities\DomainEntity;
use ZnSandbox\Sandbox\Bundle\Domain\Interfaces\Services\BundleServiceInterface;
use ZnSandbox\Sandbox\Generator\Domain\Helpers\TableMapperHelper;
use ZnDatabase\Base\Domain\Repositories\Eloquent\SchemaRepository;

class SelectDomainInput extends BaseInput
{

    private $domainEntity;
    private $bundleService;

    public function __construct(
        BundleServiceInterface $bundleService
    )
    {
        $this->bundleService = $bundleService;
    }

    public function getDomainEntity(): DomainEntity
    {
        return $this->domainEntity;
    }

    public function setDomainEntity(DomainEntity $domainEntity): void
    {
        $this->domainEntity = $domainEntity;
    }

    public function run(): DomainEntity
    {
        /** @var BundleEntity[] $bundleCollection */
        $bundleCollection = $this->bundleService->findAll();
        $domainCollection = [];
        $domainCollectionNamespaces = [];
        foreach ($bundleCollection as $bundleEntity) {
            if ($bundleEntity->getDomain()) {
//                $domainNamespace = ClassHelper::getNamespace($bundleEntity->getDomain()->getClassName());
                $domainNamespace = $bundleEntity->getNamespace();
                $domainName = $bundleEntity->getDomain()->getName();
                $title = "$domainName ($domainNamespace)";
                $domainCollection[] = $title;
                $domainCollectionNamespaces[$title] = $bundleEntity->getDomain();
            }
            // dd($domainNamespace);
        }

        $question = new ChoiceQuestion(
            'Select domain',
            $domainCollection
        );
        $selectedDomain = $this->getCommand()->getHelper('question')->ask($this->getInput(), $this->getOutput(), $question);
        $this->addResultParam('domainEntity', $domainCollectionNamespaces[$selectedDomain]);
        return $domainCollectionNamespaces[$selectedDomain];
    }
}
