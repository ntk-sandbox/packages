<?php

namespace Untek\Lib\Components\Format\Encoders;

use Untek\Core\Contract\Encoder\Interfaces\EncoderInterface;

/**
 * Base64-сериализатор
 */
class Base64Encoder implements EncoderInterface
{

    public function encode($data)
    {
        return base64_encode($data);
    }

    public function decode($encodedData)
    {
        return base64_decode($encodedData);
    }
}