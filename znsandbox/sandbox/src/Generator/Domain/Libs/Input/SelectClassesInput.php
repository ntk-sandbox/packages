<?php

namespace ZnSandbox\Sandbox\Generator\Domain\Libs\Input;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ZnFramework\Console\Symfony4\Question\ChoiceQuestion;
use ZnSandbox\Sandbox\Bundle\Domain\Entities\DomainEntity;

class SelectClassesInput extends BaseInput
{

    /*public function __construct(
        InputInterface $input,
        OutputInterface $output,
        Command $command)
    {
        $this->input = $input;
        $this->output = $output;
        $this->command = $command;
    }*/

    public function run() {
        $classes = [
            'entity',
            'repository',
            'service',
        ];

        $question = new ChoiceQuestion(
            'Select classes',
            $classes,
            'a'
        );
        $question->setMultiselect(true);
        $selectedClasses = $this->getCommand()->getHelper('question')->ask($this->getInput(), $this->getOutput(), $question);
        $this->addResultParam('classes', $selectedClasses);
        return $selectedClasses;
    }
}
