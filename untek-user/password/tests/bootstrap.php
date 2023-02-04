<?php

//use Untek\Core\DotEnv\Domain\Libs\DotEnv;
//DotEnv::init();

use Untek\Core\App\Interfaces\AppInterface;
use Untek\Core\Container\Libs\Container;
use Untek\Core\App\Libs\ZnCore;
use Untek\Tool\Test\Libs\TestApp;

$container = new Container();
$znCore = new ZnCore($container);
$znCore->init();

/** @var AppInterface $appFactory */
$appFactory = $container->get(TestApp::class);
$appFactory->setBundles([
    new \Untek\User\Password\Bundle(['all']),
    new \Untek\Database\Eloquent\Bundle(['all']),
    new \Untek\Database\Fixture\Bundle(['all']),
    new \Untek\Bundle\Queue\Bundle(['all']),
]);
$appFactory->init();
