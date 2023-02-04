<?php

namespace Untek\Sandbox\Sandbox\WebTest\Domain\Encoders;

use Untek\Core\Collection\Libs\Collection;
use Untek\Lib\Components\Format\Encoders\BaseChainEncoder;
use Untek\Lib\Components\Format\Encoders\PhpSerializeEncoder;
use Untek\Lib\Components\Format\Encoders\SafeBase64Encoder;

class IsolateEncoder extends BaseChainEncoder
{

    public function __construct()
    {
        $this->encoderCollection = new Collection();
        $this->encoderCollection->add(new PhpSerializeEncoder());
        $this->encoderCollection->add(new SafeBase64Encoder());
    }
}
