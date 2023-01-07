<?php

namespace ZnSandbox\Sandbox\WebTest\Commands;

use Symfony\Component\Console\Command\Command;
use ZnCore\Collection\Libs\Collection;
use ZnLib\Components\Format\Encoders\ChainEncoder;
use ZnLib\Components\Format\Encoders\PhpSerializeEncoder;
use ZnLib\Components\Format\Encoders\SafeBase64Encoder;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\AppFactory;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\HttpClient;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\JsonHttpClient;

abstract class BaseCommand extends Command
{

    protected function createHttpClient(AppFactory $appFactory = null): JsonHttpClient
    {
        $httpClient = new JsonHttpClient($appFactory);
//        $httpClient = new HttpClient($appFactory);
        return $httpClient;
    }

    protected function createEncoder()
    {
        $requestEncoder = new ChainEncoder(
            new Collection(
                [
                    new PhpSerializeEncoder(),
                    new SafeBase64Encoder(),
                ]
            )
        );
        return $requestEncoder;
    }

}
