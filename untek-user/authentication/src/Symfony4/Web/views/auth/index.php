<?php

/**
 * @var $formView FormView|AbstractType[]
 */

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Untek\Core\Container\Helpers\ContainerHelper;
use Untek\Lib\Web\Form\Libs\FormRender;

/** @var CsrfTokenManagerInterface $tokenManager */
$tokenManager = ContainerHelper::getContainer()->get(CsrfTokenManagerInterface::class);
$formRender = new FormRender($formView, $tokenManager);
$formRender->addFormOption('autocomplete', 'off');

?>

<?= $formRender->errors() ?>

<?= $formRender->beginFrom() ?>

<div class="form-group field-form-login required has-error">
    <?= $formRender->label('login') ?>
    <?= $formRender->input('login', 'text') ?>
    <?= $formRender->hint('login') ?>
</div>
<div class="form-group field-form-password required">
    <?= $formRender->label('password') ?>
    <?= $formRender->input('password', 'password', [
            'autocomplete' => 'off',
    ]) ?>
    <?= $formRender->hint('password') ?>
</div>
<div class="form-group field-form-rememberme">
    <div class="checkbox">
        <?= $formRender->input('rememberMe', 'checkbox') ?>
        <?= $formRender->label('rememberMe') ?>
        <?= $formRender->hint('rememberMe') ?>
    </div>
</div>
<div class="form-group">
    <?= $formRender->input('save', 'submit') ?>
</div>

<?= $formRender->endFrom() ?>

<a href="/restore-password"><?= \Untek\Lib\I18Next\Facades\I18Next::t('authentication', 'auth.forgot_title') ?></a>
