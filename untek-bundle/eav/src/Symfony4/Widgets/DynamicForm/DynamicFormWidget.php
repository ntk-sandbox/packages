<?php

namespace Untek\Bundle\Eav\Symfony4\Widgets\DynamicForm;

use Symfony\Component\Form\FormView;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Untek\Lib\Web\Form\Libs\FormRender;
use Untek\Lib\Web\Widget\Base\BaseWidget2;

class DynamicFormWidget extends BaseWidget2
{

    /** @var FormView */
    private $formView;

    /** @var CsrfTokenManagerInterface */
    private $tokenManager;

    /** @var FormRender */
    private $formRender;

    public function __construct(CsrfTokenManagerInterface $tokenManager)
    {
        $this->tokenManager = $tokenManager;
    }

    public function setFormView(FormView $formView): void
    {
        $this->formView = $formView;
    }

    public function setFormRender(FormRender $formRender): void
    {
        $this->formRender = $formRender;
    }

    public function run(): string
    {
        if (isset($this->formRender)) {
            $formRender = $this->formRender;
        } else {
            $formRender = new FormRender($this->formView, $this->tokenManager);
        }
        return $this->render('index', [
            'formRender' => $formRender,
        ]);
    }
}
