<?php

namespace ZnLib\Components\Format\Encoders;

use ZnCore\Contract\Encoder\Interfaces\EncoderInterface;

/**
 * PHP-сериализатор.
 */
class PhpSerializeEncoder implements EncoderInterface
{

    public function encode($data)
    {
        return serialize($data);
    }

    public function decode($encodedData)
    {
        return unserialize($encodedData);
    }
}