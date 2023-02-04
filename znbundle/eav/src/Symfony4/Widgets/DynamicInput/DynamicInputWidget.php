<?php

namespace Untek\Bundle\Eav\Symfony4\Widgets\DynamicInput;

use Symfony\Component\Form\FormView;
use Untek\Lib\Web\Form\Libs\FormRender;
use Untek\Lib\Web\Widget\Base\BaseWidget2;

class DynamicInputWidget extends BaseWidget2
{

    /** @var FormRender */
    private $formRender;

    public function setFormRender(FormRender $formRender): void
    {
        $this->formRender = $formRender;
    }

    public function run(): string
    {
        $formView = $this->formRender->getFormView();
        $html = '';
        foreach ($formView->children as $name => $type) {
            if ($name != 'save') {
                $html .= $this->formRender->row($name);
            }
        }
        return $html;
    }
}
