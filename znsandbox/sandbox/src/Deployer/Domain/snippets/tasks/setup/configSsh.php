<?php

return [
    'title' => 'Development setup. Config SSH for git',
    'tasks' => [
        [
            'class' => \ZnSandbox\Sandbox\Deployer\Domain\Tasks\Setup\RegisterSshKeysTask::class,
//        'title' => '',
        ],
    ],
];
