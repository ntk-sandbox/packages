<?php

namespace Untek\Lib\Components\Format\Encoders;

use Untek\Core\Contract\Encoder\Interfaces\EncoderInterface;

/**
 * Hex-сериализатор
 */
class HexEncoder implements EncoderInterface
{

    public function encode($data)
    {
        return bin2hex($data);
    }

    public function decode($encodedData)
    {
        return hex2bin($encodedData);
    }
}