<?php

use Zn\Example\Plus;

$namespaces = [
    'Zn\\Example' => __DIR__ . '/../src/Example',
];

//dd(class_exists(\ZnCore\Code\Helpers\ComposerHelper::class));

foreach ($namespaces as $namespace => $path) {
    $path = realpath($path);
//    dd(\ZnCore\FileSystem\Helpers\FileHelper::scanDir($path));
    //dd($namespace, $path);
    //\ZnCore\Code\Helpers\ComposerHelper::register($namespace, $path);
    //dd(Plus::run(1, 6));
}
