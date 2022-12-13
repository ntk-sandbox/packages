<?php

/**
 * @var $formView FormView|AbstractType[]
 */

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use ZnCore\Container\Helpers\ContainerHelper;
use ZnLib\Web\Form\Libs\FormRender;

/** @var CsrfTokenManagerInterface $tokenManager */
$tokenManager = ContainerHelper::getContainer()->get(CsrfTokenManagerInterface::class);
$formRender = new FormRender($formView, $tokenManager);
//$formRender->addFormOption('autocomplete', 'off');
//$formRender->addFormOption('enctype', 'multipart/form-data');

?>

<?= $formRender->errors() ?>

<?= $formRender->beginFrom() ?>

<div class="form-group required has-error">
    <?= $formRender->label('serviceId') ?>
    <?= $formRender->input('serviceId') ?>
    <?= $formRender->hint('serviceId') ?>
</div>
<div class="form-group required has-error">
    <?= $formRender->label('entityId') ?>
    <?= $formRender->input('entityId') ?>
    <?= $formRender->hint('entityId') ?>
</div>
<div class="form-group required has-error">
    <?= $formRender->label('file') ?>
    <?= $formRender->input('file') ?>
    <?= $formRender->hint('file') ?>
</div>

<div class="form-group">
    <?= $formRender->input('save', 'submit') ?>
</div>

<?= $formRender->endFrom() ?>
