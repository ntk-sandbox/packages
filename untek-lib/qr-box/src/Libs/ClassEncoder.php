<?php

namespace Untek\Lib\QrBox\Libs;

use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Core\Collection\Libs\Collection;
use Untek\Lib\Components\Format\Encoders\ChainEncoder;

class ClassEncoder
{

    private $assoc = [];

    public function __construct(array $assoc)
    {
        $this->assoc = $assoc;
    }

    private function encoderToClass(string $name)
    {
        return ArrayHelper::getValue($this->assoc, $name);
    }

    public function encodersToClasses(array $names): ChainEncoder
    {
        $classes = [];
        foreach ($names as $name) {
            $classes[] = $this->encoderToClass($name);
        }
        $encoders = new ChainEncoder(new Collection($classes));
        return $encoders;
    }
}