<?php

namespace Untek\Lib\QrBox\Encoders;

class Base64Encoder extends \Untek\Lib\Components\Format\Encoders\Base64Encoder implements EntityEncoderInterface
{

    public function compressionRate(): float
    {
        return 4 / 3;
    }
}