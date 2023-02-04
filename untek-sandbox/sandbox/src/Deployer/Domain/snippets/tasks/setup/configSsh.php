<?php

return [
    'title' => 'Development setup. Config SSH for git',
    'tasks' => [
        [
            'class' => \Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Setup\RegisterSshKeysTask::class,
//        'title' => '',
        ],
    ],
];
