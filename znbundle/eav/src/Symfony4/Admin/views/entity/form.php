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

<div class="form-group required">
    <?= $formRender->label('categoryId') ?>
    <?= $formRender->input('categoryId', 'text') ?>
    <?= $formRender->hint('categoryId') ?>
</div>
<div class="form-group required">
    <?= $formRender->label('name') ?>
    <?= $formRender->input('name', 'text') ?>
    <?= $formRender->hint('name') ?>
</div>
<div class="form-group required">
    <?= $formRender->label('title') ?>
    <?= $formRender->input('title', 'text') ?>
    <?= $formRender->hint('title') ?>
</div>
<div class="form-group required">
    <?= $formRender->label('handler') ?>
    <?= $formRender->input('handler', 'text') ?>
    <?= $formRender->hint('handler') ?>
</div>

<div class="form-group">
    <?= $formRender->input('save', 'submit') ?>
</div>

<?= $formRender->endFrom() ?>
