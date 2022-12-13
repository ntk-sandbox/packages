<?php

return [
    'title' => 'Development setup. PHP',
    'tasks' => [
        [
            'class' => \ZnLib\Components\ShellRobot\Domain\Tasks\LinuxPackage\AddPackageRepositoryTask::class,
            'repository' => 'ppa:ondrej/php',
//        'title' => '',
        ],
        [
            'class' => \ZnLib\Components\ShellRobot\Domain\Tasks\LinuxPackage\InstallLinuxPackageTask::class,
            'package' => [
                '{{phpv}}',
                '{{phpv}}-cli',
                '{{phpv}}-common',
            ],
            'withUpdate' => true,
            'title' => '## Install base PHP packages',
        ],
        [
            'class' => \ZnLib\Components\ShellRobot\Domain\Tasks\LinuxPackage\InstallLinuxPackageTask::class,
            'package' => [
                '{{phpv}}-gmp',
                '{{phpv}}-curl',
                '{{phpv}}-zip',
                '{{phpv}}-gd',
                '{{phpv}}-json',
                '{{phpv}}-mbstring',
                '{{phpv}}-intl',
                '{{phpv}}-mysql',
                '{{phpv}}-sqlite3',
                '{{phpv}}-xml',
                '{{phpv}}-zip',
                '{{phpv}}-imagick',
            ],
            'withUpdate' => true,
            'title' => '## Install ext PHP packages',
        ],
        [
            'class' => \ZnSandbox\Sandbox\Deployer\Domain\Tasks\Setup\ConfigPhpTask::class,
            'apacheIniConfig' => [
                'short_open_tag' => 'On',
            ],
            'cliIniConfig' => [
                'short_open_tag' => 'On',
                'memory_limit' => '512M',
                'max_input_time' => '600',
                'max_execution_time' => '120',
            ],
        ],
        [
            'class' => \ZnSandbox\Sandbox\Deployer\Domain\Tasks\Composer\InstallComposerToSystemTask::class,
//            'title' => '',
        ],
    ],
];
