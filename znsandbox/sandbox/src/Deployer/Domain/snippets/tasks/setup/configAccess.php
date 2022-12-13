<?php

return [
    'title' => 'Server. Config access',
    'tasks' => [
        [
            'class' => \ZnSandbox\Sandbox\Deployer\Domain\Tasks\Setup\RegisterPublicKeyTask::class,
//        'title' => '',
        ],
        [
            'class' => \ZnSandbox\Sandbox\Deployer\Domain\Tasks\Setup\SetSudoPasswordTask::class,
//        'title' => '',
        ],
    ],
];
