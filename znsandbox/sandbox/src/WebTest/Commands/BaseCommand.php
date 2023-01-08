<?php

namespace ZnSandbox\Sandbox\WebTest\Commands;

use Symfony\Component\Console\Command\Command;
use ZnCore\Collection\Libs\Collection;
use ZnLib\Components\Format\Encoders\ChainEncoder;
use ZnLib\Components\Format\Encoders\PhpSerializeEncoder;
use ZnLib\Components\Format\Encoders\SafeBase64Encoder;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\HttpClient;

abstract class BaseCommand extends Command
{

    protected function createHttpClient(): HttpClient
    {
        $httpClient = new HttpClient();
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
