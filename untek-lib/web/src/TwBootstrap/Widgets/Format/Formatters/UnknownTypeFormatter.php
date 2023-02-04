<?php

namespace Untek\Lib\Web\TwBootstrap\Widgets\Format\Formatters;

use Untek\Lib\I18Next\Facades\I18Next;

class UnknownTypeFormatter extends BaseFormatter implements FormatterInterface
{

    public $label;

    public function render($items)
    {
        return $this->label ?? I18Next::t('core', 'main.unknown_type');
    }
}
