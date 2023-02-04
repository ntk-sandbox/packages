<?php

return [
    'title' => 'Server. Config access',
    'tasks' => [
        [
            'class' => \Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Setup\RegisterPublicKeyTask::class,
//        'title' => '',
        ],
        [
            'class' => \Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Setup\SetSudoPasswordTask::class,
//        'title' => '',
        ],
    ],
];
