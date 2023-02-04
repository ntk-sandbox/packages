<?php

//\Untek\Core\DotEnv\Domain\Libs\DotEnv::init();



$container = new \Untek\Core\Container\Libs\Container();
$Untek\Core = new \Untek\Core\App\Libs\ZnCore($container);
$znCore->init();

/** @var \Untek\Core\App\Interfaces\AppInterface $appFactory */
//$appFactory = $container->get(\Untek\Tool\Test\Libs\TestApp::class);
/*$appFactory->setBundles([
    
]);*/
//$appFactory->init();

/*$znCore->loadBundles([
    
]);*/
