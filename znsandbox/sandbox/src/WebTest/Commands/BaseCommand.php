<?php

namespace ZnSandbox\Sandbox\WebTest\Commands;

use Symfony\Component\Console\Command\Command;
use ZnCore\Collection\Libs\Collection;
use ZnLib\Components\Format\Encoders\ChainEncoder;
use ZnLib\Components\Format\Encoders\PhpSerializeEncoder;
use ZnLib\Components\Format\Encoders\SafeBase64Encoder;

abstract class BaseCommand extends Command
{

    protected function createEncoder()
    {
        $encoders = [
            new PhpSerializeEncoder(),
            new SafeBase64Encoder(),
        ];
        $requestEncoder = new ChainEncoder(new Collection($encoders));
        return $requestEncoder;
    }
}
