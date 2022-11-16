<?php

namespace ZnLib\Components\ShellRobot\Domain\Services;

use ZnLib\Components\ShellRobot\Domain\Factories\ShellFactory;
use ZnLib\Components\ShellRobot\Domain\Libs\App\TaskProcessor;
use ZnFramework\Console\Domain\Libs\IO;

class TaskService
{

    private $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function runTasks(array $profileNames, IO $io): void
    {
        foreach ($profileNames as $profileName) {
            $this->run($profileName, $io);
        }
    }

    private function run(string $profileName, IO $io): void
    {
        $profileConfig = $this->profileService->findOneByName($profileName);
        $io->getOutput()->writeln(['', "<fg=blue>## {$profileConfig['title']}</>", '']);
        ShellFactory::getVarProcessor()->setList($profileConfig['vars'] ?? []);
        ShellFactory::getVarProcessor()->set('currentProfile', $profileName);
        TaskProcessor::runTaskList($profileConfig['tasks'], $io);
    }
}
