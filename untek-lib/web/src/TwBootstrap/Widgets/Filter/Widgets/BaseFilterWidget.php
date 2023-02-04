<?php

namespace Untek\Lib\Web\TwBootstrap\Widgets\Filter\Widgets;

use Untek\Lib\Web\Html\Helpers\Html;
use Untek\Lib\Web\Widget\Base\BaseWidget2;

class BaseFilterWidget extends BaseWidget2
{

    public $type;
    public $name;
    public $value;
    public $options = [
        'class' => 'form-control',
    ];

    public function run(): string
    {
        $name = 'filter[' . $this->name . ']';
        return Html::input($this->type, $name, $this->value, $this->options);
    }
}