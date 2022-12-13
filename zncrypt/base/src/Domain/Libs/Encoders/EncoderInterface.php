<?php

namespace ZnCrypt\Base\Domain\Libs\Encoders;

interface EncoderInterface
{

    public function encode($data);
    public function decode($encodedData);

}