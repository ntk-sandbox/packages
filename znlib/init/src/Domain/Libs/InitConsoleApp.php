<?php

namespace ZnLib\Init\Domain\Libs;

use ZnFramework\Console\Symfony4\Base\BaseConsoleApp;

class InitConsoleApp extends BaseConsoleApp
{

    protected function bundles(): array
    {
        return [
            \ZnLib\Init\Bundle::class,
        ];
    }

    /*protected function initBundles(): void
    {
        $this->addBundles([
            \ZnLib\Init\Bundle::class,
        ]);
        parent::initBundles();
    }*/
}
