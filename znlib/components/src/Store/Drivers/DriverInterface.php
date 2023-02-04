<?php

namespace Untek\Lib\Components\Store\Drivers;

interface DriverInterface
{

    public function decode($content);

    public function encode($data);

}