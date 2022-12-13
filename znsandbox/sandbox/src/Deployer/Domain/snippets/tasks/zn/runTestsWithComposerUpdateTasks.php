<?php

use ZnLib\Components\ShellRobot\Domain\Tasks\FileSystem\SetPermissionTask;
use ZnSandbox\Sandbox\Deployer\Domain\Tasks\Composer\ComposerInstallTask;
use ZnSandbox\Sandbox\Deployer\Domain\Tasks\Deploy\ConfigureDomainTask;
use ZnSandbox\Sandbox\Deployer\Domain\Tasks\Tests\InitReleaseTask;
use ZnSandbox\Sandbox\Deployer\Domain\Tasks\Deploy\MakeLinkForCurrentReleaseTask;
use ZnSandbox\Sandbox\Deployer\Domain\Tasks\Git\GitCloneTask;
use ZnSandbox\Sandbox\Deployer\Domain\Tasks\Zn\ZnImportFixtureTask;
use ZnSandbox\Sandbox\Deployer\Domain\Tasks\Zn\ZnInitTask;
use ZnSandbox\Sandbox\Deployer\Domain\Tasks\Zn\ZnMigrateUpTask;

\ZnCore\Code\Helpers\DeprecateHelper::hardThrow();

return [
    [
        'class' => InitReleaseTask::class,
    ],
    [
        'class' => GitCloneTask::class,
        'directory' => '{{releasePath}}',
        'repositoryLink' => '{{gitRepositoryLink}}',
        'branch' => '{{gitBranch}}',
    ],
    [
        'class' => \ZnSandbox\Sandbox\Deployer\Domain\Tasks\Composer\ComposerUpdateTask::class,
        'directory' => '{{releasePath}}',
//            'noDev' => true,
    ],
    [
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
    [
        'class' => ZnInitTask::class,
        'profile' => '{{znInitProfile}}',
    ],
    [
        'class' => ZnMigrateUpTask::class,
        'env' => \ZnCore\Env\Enums\EnvEnum::TEST,
    ],
    [
        'class' => ZnMigrateUpTask::class,
//        'env' => \ZnCore\Env\Enums\EnvEnum::TEST,
    ],
    [
        'class' => ConfigureDomainTask::class,
        'domains' => [
            [
                'domain' => '{{baseDomain}}',
                'directory' => '{{currentPath}}/public',
            ],
        ],
    ],
    [
        'class' => \ZnSandbox\Sandbox\Deployer\Domain\Tasks\Apache\ApacheRestartTask::class,
    ],

    [
        'class' => \ZnSandbox\Sandbox\Deployer\Domain\Tasks\PhpUnit\RunPhpUnitTestTask::class,
    ],
];
