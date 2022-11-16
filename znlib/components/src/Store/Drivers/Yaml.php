<?php

namespace ZnLib\Components\Store\Drivers;

use Symfony\Component\Yaml\Yaml as SymfonyYaml;

class Yaml implements DriverInterface
{

    private $indent;

    public function __construct(int $indent = 4)
    {
        $this->indent = $indent;
    }

    public function decode($content)
    {

        $data = SymfonyYaml::parse($content);
        //$data = ArrayHelper::toArray($data);
        return $data;
    }

    public function encode($data)
    {
        $content = SymfonyYaml::dump($data, 1000, $this->indent);
        //$content = str_replace('    ', "\t", $content);
        return $content;
    }

}