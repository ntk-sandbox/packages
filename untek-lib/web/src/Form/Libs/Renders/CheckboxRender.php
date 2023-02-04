<?php

namespace Untek\Lib\Web\Form\Libs\Renders;

use Untek\Lib\Web\Html\Helpers\Html;

class CheckboxRender extends BaseInputRender
{

    public function defaultOptions(): array {
        return [
            'type' => 'checkbox',
        ];
    }

    public function render(): string
    {
        $options = $this->options();
        $value = $this->getViewOptions()['data'];
        if ($value) {
            $options['checked'] = 'checked';
        }
        $labelHtml = $this->getViewOption('label');
        $input = Html::tag('input', '', $options) /*. $labelHtml*/;
        /*$label = Html::tag('label', null, [
            'for' => $this->getViewOption('id'),
        ]);*/
        return $input;
    }
}
