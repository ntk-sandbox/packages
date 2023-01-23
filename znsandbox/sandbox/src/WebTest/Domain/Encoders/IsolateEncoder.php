<?php

namespace ZnSandbox\Sandbox\WebTest\Domain\Encoders;

use ZnCore\Collection\Libs\Collection;
use ZnLib\Components\Format\Encoders\BaseChainEncoder;
use ZnLib\Components\Format\Encoders\PhpSerializeEncoder;
use ZnLib\Components\Format\Encoders\SafeBase64Encoder;

class IsolateEncoder extends BaseChainEncoder
{

    public function __construct()
    {
        $this->encoderCollection = new Collection();
        $this->encoderCollection->add(new PhpSerializeEncoder());
        $this->encoderCollection->add(new SafeBase64Encoder());
    }
}
