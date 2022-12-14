<?php

namespace ZnFramework\Console\Domain\Base;

use Symfony\Component\Process\Process;
use ZnLib\Components\Time\Enums\TimeEnum;
use ZnFramework\Console\Domain\Helpers\CommandLineHelper;

abstract class BaseShellNew
{

    protected $lang = 'en_GB';
    protected $path = null;
    private $sudo = false;

    public function isSudo(): bool
    {
        return $this->sudo;
    }

    public function setSudo(bool $sudo): void
    {
        $this->sudo = $sudo;
    }

    public function sudo($sudo = true): self
    {
        $this->sudo = $sudo;
        $clone = clone $this;
        $clone->setSudo($sudo);
        return $clone;
    }

    public function runCommand($command, ?string $path = null): string
    {
        $path = $path OR $this->path;
        $commandString = CommandLineHelper::argsToString($command, $this->lang);
        return $this->runCommandRaw($commandString, $path);
    }

    private $commands = [];

    public function addCommand($command, ?string $path = null): self
    {
        $this->commands[] = $command;
        return $this;
    }

    public function run()
    {
        $commandString = implode(' && ', $this->commands);
        return $this->runCommand($commandString);
    }

    public function runCommandRaw(string $commandString, ?string $path = null): string
    {
        $commandString = $this->prepareCommandString($commandString);
//        dump($commandString);

        $process = Process::fromShellCommandline($commandString, $path);
        $process->setTimeout(TimeEnum::SECOND_PER_YEAR);

        /*$process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }*/

        CommandLineHelper::run($process);

        $commandOutput = $process->getOutput();
        return $commandOutput;
    }

    protected function prepareCommandString(string $commandString): string
    {
//        $commandString = VarProcessor::process($commandString);
        return $commandString;
    }

    public function test($command, ?string $path = null): string
    {
        $commandString = "if $command; then echo 'true'; fi";
        $out = $this->runCommandRaw($commandString, $path);
        return $this->isTrueOut($out);
    }

    public function isTrueOut($out): bool
    {
        $out = trim($out);
        return $out === 'true';
    }
}
