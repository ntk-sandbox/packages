<?php

$virtualMachineName = getenv('DEPLOYER_VIRTUAL_BOX_NAME');
$virtualBoxDirectory = getenv('DEPLOYER_VIRTUAL_BOX_DIRECTORY');
$backupZipFile = getenv('DEPLOYER_VIRTUAL_BOX_BACKUP_FILE');

return [
    'title' => 'Server. Hard reset',
    'tasks' => [
        [
            'class' => \Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Vbox\ShutdownServerTask::class,
            'name' => $virtualMachineName,
        ],
        [
            'class' => \Untek\Lib\Components\ShellRobot\Domain\Tasks\Common\WaitTask::class,
            'seconds' => 5,
            'title' => '  Wait for the server to shutdown ({{seconds}} sec.)',
        ],
        [
            'class' => \Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Vbox\RemoveServerTask::class,
            'name' => $virtualMachineName,
            'directory' => $virtualBoxDirectory,
        ],
        [
            'class' => \Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Vbox\RestoreServerTask::class,
            'directory' => $virtualBoxDirectory,
            'backup' => $backupZipFile,
        ],
        [
            'class' => \Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Vbox\StartServerTask::class,
            'name' => $virtualMachineName,
        ],
        [
            'class' => \Untek\Lib\Components\ShellRobot\Domain\Tasks\Common\WaitTask::class,
            'seconds' => 10,
            'title' => '  Wait for the server to start ({{seconds}} sec.)',
        ],
    ]
];
