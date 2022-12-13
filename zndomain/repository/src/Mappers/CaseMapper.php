<?php

namespace ZnDomain\Repository\Mappers;

use ZnCore\Contract\Common\Exceptions\InvalidMethodParameterException;
use ZnCore\Text\Helpers\Inflector;
use ZnDomain\Repository\Interfaces\MapperInterface;

class CaseMapper implements MapperInterface
{

    public function __construct(private $fromCase = Inflector::CAMEL_CASE, private $toCase = Inflector::SNACK_CASE)
    {
    }

    public function encode($entityAttributes)
    {
        $new = [];
        foreach ($entityAttributes as $name => $value) {
            $newName = $this->encodeName($name);
            $new[$newName] = $value;
        }
        return $new;
    }

    public function decode($rowAttributes)
    {
        $new = [];
        foreach ($rowAttributes as $name => $value) {
            $newName = $this->decodeName($name);
            $new[$newName] = $value;
        }
        return $new;
    }

    private function decodeName(string $name): string
    {
        return Inflector::toCase($name, $this->fromCase);
    }

    private function encodeName(string $name): string
    {
        return Inflector::toCase($name, $this->toCase);
    }
}
