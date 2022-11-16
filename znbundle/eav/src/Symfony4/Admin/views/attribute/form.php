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

?>

<?= $formRender->errors() ?>

<?= $formRender->beginFrom() ?>

<div class="form-group">
    <?= $formRender->label('title') ?>
    <?= $formRender->input('title', 'text') ?>
    <?= $formRender->hint('title') ?>
</div>
<div class="form-group">
    <?= $formRender->label('name') ?>
    <?= $formRender->input('name', 'text') ?>
    <?= $formRender->hint('name') ?>
</div>
<div class="form-group">
    <?= $formRender->label('type') ?>
    <?= $formRender->input('type', 'select') ?>
    <?= $formRender->hint('type') ?>
</div>
<div class="form-group">
    <?= $formRender->label('default') ?>
    <?= $formRender->input('default', 'text') ?>
    <?= $formRender->hint('default') ?>
</div>
<div class="form-group">
    <?= $formRender->label('description') ?>
    <?= $formRender->input('description', 'text') ?>
    <?= $formRender->hint('description') ?>
</div>
<div class="form-group">
    <?= $formRender->label('unitId') ?>
    <?= $formRender->input('unitId', 'text') ?>
    <?= $formRender->hint('unitId') ?>
</div>

<div class="form-group">
    <?= $formRender->input('save', 'submit') ?>
</div>

<?= $formRender->endFrom() ?>
