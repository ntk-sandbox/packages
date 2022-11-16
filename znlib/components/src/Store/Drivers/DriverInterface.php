<?php

namespace ZnLib\Components\Store\Drivers;

interface DriverInterface
{

    public function decode($content);

    public function encode($data);

}