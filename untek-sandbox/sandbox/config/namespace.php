<?php

use Untek\\Example\Plus;

$namespaces = [
    'Untek\\\Example' => __DIR__ . '/../src/Example',
];

//dd(class_exists(\Untek\Core\Code\Helpers\ComposerHelper::class));

foreach ($namespaces as $namespace => $path) {
    $path = realpath($path);
//    dd(\Untek\Core\FileSystem\Helpers\FileHelper::scanDir($path));
    //dd($namespace, $path);
    //\Untek\Core\Code\Helpers\ComposerHelper::register($namespace, $path);
    //dd(Plus::run(1, 6));
}
