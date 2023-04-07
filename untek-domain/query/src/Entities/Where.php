<?php

namespace Untek\Model\Query\Entities;

use Untek\Model\Query\Enums\OperatorEnum;

class Where
{

    public $column;
    public $operator;
    public $value;
    public $boolean;
    public $not;

    public function __construct(string $column = null, $value = null, string $operator = OperatorEnum::EQUAL, string $boolean = 'and', bool $not = false)
    {
        $this->column = $column;
        $this->value = $value;
        $this->operator = $operator;
        $this->boolean = $boolean;
        $this->not = $not;
    }
}
