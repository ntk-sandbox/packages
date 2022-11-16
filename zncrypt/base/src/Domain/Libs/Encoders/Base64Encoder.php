<?php

namespace ZnCrypt\Base\Domain\Libs\Encoders;

use ZnCrypt\Base\Domain\Helpers\SafeBase64Helper;

class Base64Encoder implements EncoderInterface
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
