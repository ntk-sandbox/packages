<?php

use Untek\Lib\Components\ShellRobot\Domain\Tasks\FileSystem\SetPermissionTask;
use Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Composer\ComposerInstallTask;
use Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Deploy\ConfigureDomainTask;
use Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Tests\InitReleaseTask;
use Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Deploy\MakeLinkForCurrentReleaseTask;
use Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Git\GitCloneTask;
use Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Zn\ZnImportFixtureTask;
use Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Zn\ZnInitTask;
use Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Zn\ZnMigrateUpTask;

\Untek\Core\Code\Helpers\DeprecateHelper::hardThrow();

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
        'class' => \Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Composer\ComposerUpdateTask::class,
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
        'env' => \Untek\Core\Env\Enums\EnvEnum::TEST,
    ],
    [
        'class' => ZnMigrateUpTask::class,
//        'env' => \Untek\Core\Env\Enums\EnvEnum::TEST,
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
        'class' => \Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Apache\ApacheRestartTask::class,
    ],

    [
        'class' => \Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\PhpUnit\RunPhpUnitTestTask::class,
    ],
];
