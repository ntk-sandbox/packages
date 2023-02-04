<?php

namespace Untek\Lib\QrBox\Encoders;

class HexEncoder extends \Untek\Lib\Components\Format\Encoders\HexEncoder implements EntityEncoderInterface
{

    public function compressionRate(): float
    {
        return 2;
    }
}