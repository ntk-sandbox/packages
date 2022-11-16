<?php

//use ZnCore\DotEnv\Domain\Libs\DotEnv;
//DotEnv::init();

use ZnCore\App\Interfaces\AppInterface;
use ZnCore\Container\Libs\Container;
use ZnCore\App\Libs\ZnCore;
use ZnTool\Test\Libs\TestApp;

$container = new Container();
$znCore = new ZnCore($container);
$znCore->init();

/** @var AppInterface $appFactory */
$appFactory = $container->get(TestApp::class);
$appFactory->setBundles([
    new \ZnUser\Password\Bundle(['all']),
]);
$appFactory->init();
