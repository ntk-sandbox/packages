<?php

return [
    'title' => 'Development setup. Apache2',
    'tasks' => [
        [
            'class' => \ZnLib\Components\ShellRobot\Domain\Tasks\LinuxPackage\InstallLinuxPackageTask::class,
            'package' => 'apache2',
        ],
        [
            'class' => \ZnSandbox\Sandbox\Deployer\Domain\Tasks\Apache\ApacheConfigModRewriteTask::class,
            'status' => true,
        ],
        [
            'class' => \ZnLib\Components\ShellRobot\Domain\Tasks\FileSystem\SetPermissionTask::class,
            'config' => [
                [
                    'path' => '/etc/apache2',
                    'permission' => 'ugo+rwx',
                ],
                [
                    'path' => '/var/www',
                    'owner' => '{{userName}}:www-data',
                    'permission' => 'g+s',
                ],
            ],
        ],

        [
            'class' => \ZnLib\Components\ShellRobot\Domain\Tasks\FileSystem\MakeSoftLinkTask::class,
            'sourceFilePath' => '/etc/apache2/sites-available',
            'linkFilePath' => '/etc/apache2/sites-enabled',
            'title' => 'Make Soft Link "sites-enabled" -> "sites-available"',
        ],
        [
            'class' => \ZnLib\Components\ShellRobot\Domain\Tasks\FileSystem\CopyToRemoteTask::class,
            'sourceFilePath' => realpath(__DIR__ . '/../../../../resources/apache2.conf'),
            'destFilePath' => '/etc/apache2/apache2.conf',
            'title' => 'Copy Apahe2 config to server',
        ],
        [
            'class' => \ZnSandbox\Sandbox\Deployer\Domain\Tasks\Apache\ApacheConfigAutorunTask::class,
            'status' => true,
        ],
        [
            'class' => \ZnSandbox\Sandbox\Deployer\Domain\Tasks\Apache\ApacheRestartTask::class,
        ],
    ],
];
