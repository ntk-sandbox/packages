<?php

namespace ZnLib\Components\Format\Encoders;

use ZnCore\Contract\Encoder\Interfaces\EncoderInterface;
use ZnCrypt\Base\Domain\Helpers\SafeBase64Helper;

/**
 * Безопасный Base64-сериализатор для URL.
 */
class SafeBase64Encoder implements EncoderInterface
{

    public function encode($data)
    {
        return SafeBase64Helper::encode($data);
    }

    public function decode($encodedData)
    {
        return SafeBase64Helper::decode($encodedData);
    }
}