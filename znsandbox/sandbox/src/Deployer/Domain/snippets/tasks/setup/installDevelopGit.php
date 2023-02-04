<?php

return [
    'title' => 'Development setup. Git',
    'tasks' => [
        [
            'class' => \Untek\Lib\Components\ShellRobot\Domain\Tasks\LinuxPackage\InstallLinuxPackageTask::class,
            'package' => 'git',
            'withUpdate' => true,
        ],
        [
            'class' => \Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Setup\RegisterSshKeysTask::class,
            'title' => 'Setup SSH access for git',
        ],
    ],
];
