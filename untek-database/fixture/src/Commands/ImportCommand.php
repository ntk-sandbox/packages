<?php

namespace Untek\Database\Fixture\Commands;

use Illuminate\Database\Eloquent\Collection;
use Untek\Core\Collection\Helpers\CollectionHelper;
use Untek\Database\Base\Console\Traits\OverwriteDatabaseTrait;
use Untek\Framework\Console\Symfony4\Widgets\LogWidget;
use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Database\Fixture\Domain\Entities\FixtureEntity;
use Untek\Framework\Console\Symfony4\Question\ChoiceQuestion;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends BaseCommand
{
    
    use OverwriteDatabaseTrait;
    
    protected static $defaultName = 'db:fixture:import';

    protected function configure()
    {
        parent::configure();
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Import fixture data to DB')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<fg=white># Fixture IMPORT</>');

        if (!$this->isContinue($input, $output)) {
            return 0;
        }
        
        /** @var FixtureEntity[]|Collection $tableCollection */
        $tableCollection = $this->fixtureService->allFixtures();
        $tableArray = CollectionHelper::getColumn($tableCollection, 'name');

        $withConfirm = $input->getOption('withConfirm');
        if ($withConfirm) {
            $output->writeln('');
            $question = new ChoiceQuestion(
                'Select tables for import',
                $tableArray,
                'a'
            );
            $question->setMultiselect(true);
            $selectedTables = $this->getHelper('question')->ask($input, $output, $question);
        } else {
            $selectedTables = $tableArray;
        }

        $output->writeln('');

        $logWidget = new LogWidget($output);
        $logWidget->setPretty(true);
        $logWidget->setLineLength(40);
        $this->fixtureService->importAll($selectedTables, function ($tableName) use($logWidget) {
            $logWidget->start(' ' . $tableName);
        }, function ($tableName) use($logWidget) {
            $logWidget->finishSuccess();
        });

        $output->writeln(['', '<fg=green>Fixture IMPORT success!</>', '']);
        return 0;
    }

}
