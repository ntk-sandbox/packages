<?php

namespace Untek\Kaz\Egov\Qr\Encoders;

interface EncoderInterface
{

    public function encode($data);
    public function decode($encodedData);

}
