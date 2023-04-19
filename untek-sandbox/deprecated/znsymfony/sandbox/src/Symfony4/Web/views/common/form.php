<?php

/**
 * @var HtmlRenderInterface $view
 * @var $formView FormView|AbstractType[]
 */

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Untek\Component\Web\View\Application\Services\HtmlRenderInterface;
use Untek\Core\Container\Helpers\ContainerHelper;
use Untek\Component\Web\Form\Libs\FormRender;
use Untek\Component\Web\View\Application\Services\View;

/** @var CsrfTokenManagerInterface $tokenManager */
$tokenManager = ContainerHelper::getContainer()->get(CsrfTokenManagerInterface::class);
$formRender = new FormRender($formView, $tokenManager);

$formView = $formRender->getFormView();
$formHtml = '';
foreach ($formView->children as $name => $type) {
    if ($name != 'save') {
        $formHtml .= $formRender->row($name);
    }
}

?>

<?= $formRender->errors() ?>

<?= $formRender->beginFrom() ?>

<?= $formHtml ?>

<div class="form-group">
    <?= $formRender->input('save', 'submit') ?>
</div>

<?= $formRender->endFrom() ?>
