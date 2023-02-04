<?php

namespace Untek\Bundle\Eav\Domain\Traits;

use Exception;
use InvalidArgumentException;
use Untek\Core\Text\Helpers\Inflector;

trait DynamicAttribute
{

    protected $_attributes = [];

    public function __set(string $attribute, $value)
    {
        //dd($attribute, $value);
        $attribute = Inflector::variablize($attribute);
        $this->checkHasAttribute($attribute);
        $this->{$attribute} = $value;
    }

    public function __get(string $attribute)
    {

        $attribute = Inflector::variablize($attribute);
        $this->checkHasAttribute($attribute);
        //dd($attribute);
        return $this->{$attribute} ?? null;
    }

    public function __call(string $name, array $arguments)
    {
        //dd($name, $arguments);
        $method = substr($name, 0, 3);
        $attributeName = substr($name, 3);
        $attributeName = lcfirst($attributeName);
        if ($method == 'get') {
            return $this->__get($attributeName);
        } elseif ($method == 'set') {
            $this->__set($attributeName, $arguments[0]);
            return $this;
        }
        return null;
    }

    public function attributes(): array
    {
        if (empty($this->_attributes)) {
            throw new InvalidArgumentException('No attributes for dynamic entity!');
        }
        return $this->_attributes;
    }

    protected function checkHasAttribute(string $attribute)
    {
        return;

        if (empty($this->_attributes)) {
            throw new InvalidArgumentException('No attributes for dynamic entity!');
        }
        $has = in_array($attribute, $this->_attributes);
        if (!$has) {
            throw new Exception('Not found attribute "' . $attribute . '"!');
        }
    }

    public function toArray(): array
    {
        if (empty($this->_attributes)) {
            throw new InvalidArgumentException('No attributes for dynamic entity!');
        }
        $values = [];
        foreach ($this->_attributes as $name) {
            $values[$name] = $this->__get($name);
        }
        return $values;
    }
}
