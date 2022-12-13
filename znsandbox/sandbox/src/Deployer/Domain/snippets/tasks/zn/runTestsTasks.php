<?php

use ZnCore\Env\Enums\EnvEnum;
use ZnLib\Components\ShellRobot\Domain\Tasks\FileSystem\DeleteDirectoryTask;
use ZnLib\Components\ShellRobot\Domain\Tasks\FileSystem\SetPermissionTask;
use ZnSandbox\Sandbox\Deployer\Domain\Tasks\Apache\ApacheRestartTask;
use ZnSandbox\Sandbox\Deployer\Domain\Tasks\Composer\ComposerInstallTask;
use ZnSandbox\Sandbox\Deployer\Domain\Tasks\Deploy\ConfigureDomainTask;
use ZnSandbox\Sandbox\Deployer\Domain\Tasks\Git\GitCloneTask;
use ZnSandbox\Sandbox\Deployer\Domain\Tasks\PhpUnit\RunPhpUnitTestTask;
use ZnSandbox\Sandbox\Deployer\Domain\Tasks\Tests\InitReleaseTask;
use ZnSandbox\Sandbox\Deployer\Domain\Tasks\Zn\ZnInitTask;
use ZnSandbox\Sandbox\Deployer\Domain\Tasks\Zn\ZnMigrateUpTask;

return [
    'initRelease' => [
        'class' => InitReleaseTask::class,
    ],
    'deleteReleasePath' => [
        'class' => DeleteDirectoryTask::class,
        'directoryPath' => '{{releasePath}}',
    ],
    'initGit' => [
        'class' => GitCloneTask::class,
        'directory' => '{{releasePath}}',
        'repositoryLink' => '{{gitRepositoryLink}}',
        'branch' => '{{gitBranch}}',
    ],
    'initComposer' => [
        'class' => ComposerInstallTask::class,
        'directory' => '{{releasePath}}',
//            'noDev' => true,
    ],
    'setPermissions' => [
        'class' => SetPermissionTask::class,
        'config' => [
            [
                'path' => '{{releasePath}}/var',
                'permission' => 'a+w',
            ],
            [
                'path' => '{{releasePath}}/public/uploads',
                'permission' => 'a+w',
            ],
        ],
    ],
    'znInit' => [
        'class' => ZnInitTask::class,
        'profile' => '{{znInitProfile}}',
    ],
    'znMigrateUp' => [
        'class' => ZnMigrateUpTask::class,
        'env' => EnvEnum::TEST,
    ],
    /*'znMigrateUpForMainEnv' => [
        'class' => ZnMigrateUpTask::class,
//        'env' => \ZnCore\Env\Enums\EnvEnum::TEST,
    ],*/
    'configureDomain' => [
        'class' => ConfigureDomainTask::class,
        'domains' => [
            [
                'domain' => '{{baseDomain}}',
                'directory' => '{{currentPath}}/public',
            ],
        ],
    ],
    'apacheRestart' => [
        'class' => ApacheRestartTask::class,
    ],

    'runTests' => [
        'class' => RunPhpUnitTestTask::class,
    ],
];
