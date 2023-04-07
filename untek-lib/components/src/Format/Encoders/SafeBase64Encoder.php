<?php

namespace Untek\Component\Encoder\Encoders;

use Untek\Core\Contract\Encoder\Interfaces\EncoderInterface;
use Untek\Crypt\Base\Domain\Helpers\SafeBase64Helper;

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