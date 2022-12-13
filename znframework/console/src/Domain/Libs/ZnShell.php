<?php

namespace ZnFramework\Console\Domain\Libs;

use Symfony\Component\Process\Process;
use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\FileSystem\Helpers\FilePathHelper;
use ZnFramework\Console\Domain\Helpers\CommandLineHelper;

class ZnShell
{

    public function runProcess($command): Process
    {
        $process = $this->createProcess($command);
        $process->run();
        return $process;
    }

    /**
     * @param $command
     * @param string|array $mode
     * @return Process
     */
    public function createProcess($command, string $mode = 'main'): Process
    {
        $path = FilePathHelper::rootPath() . '/vendor/ntk-sandbox/packages/znframework/console/bin';

        if(is_array($command)) {
            $commonCommand = [
                'php',
                'zn',
            ];
            $commonCommand = ArrayHelper::merge($commonCommand, $command);
            $commandString = CommandLineHelper::argsToString($commonCommand);
        } elseif (is_string()) {
            $commandString = "php zn $command";
        }


        /*$commandString = CommandLineHelper::argsToString([
            'php',
            'zn',
        ]);
        $commandString = "php " . ' ' . $command;*/
        if ($mode == 'test') {
            $commandString .= ' --env=test';
        }

        $process = Process::fromShellCommandline($commandString, $path);
        return $process;
    }
}
