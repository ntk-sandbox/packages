<?php

namespace ZnSandbox\Sandbox\Generator\Domain\Libs\Input;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class BaseInput
{

    private $input;
    private $output;
    private $command;
    private $result;

    public function getInput(): InputInterface
    {
        return $this->input;
    }

    public function setInput(InputInterface $input): void
    {
        $this->input = $input;
    }

    public function getOutput(): OutputInterface
    {
        return $this->output;
    }

    public function setOutput(OutputInterface $output): void
    {
        $this->output = $output;
    }

    public function getCommand(): Command
    {
        return $this->command;
    }

    public function setCommand(Command $command): void
    {
        $this->command = $command;
    }

    public function getResult(): array
    {
        return $this->result;
    }

    public function setResult(array $result): void
    {
        $this->result = $result;
    }

    public function addResultParam(string $name, $value): void
    {
        $this->result[$name] = $value;
    }
}
