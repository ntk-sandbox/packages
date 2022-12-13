<?php

return [
    'title' => 'Development setup. Git',
    'tasks' => [
        [
            'class' => \ZnLib\Components\ShellRobot\Domain\Tasks\LinuxPackage\InstallLinuxPackageTask::class,
            'package' => 'git',
            'withUpdate' => true,
        ],
        [
            'class' => \ZnSandbox\Sandbox\Deployer\Domain\Tasks\Setup\RegisterSshKeysTask::class,
            'title' => 'Setup SSH access for git',
        ],
    ],
];
