<?php

/**
 * @var View $view
 * @var $formRender FormRender
 */

use Untek\Bundle\Eav\Symfony4\Widgets\DynamicInput\DynamicInputWidget;
use Untek\Component\I18Next\Facades\I18Next;
use Untek\Lib\Web\Form\Libs\FormRender;
use Untek\Lib\Web\View\Libs\View;

?>

<?= $formRender->errors() ?>

<?= $formRender->beginFrom() ?>

<?= DynamicInputWidget::widget([
    'formRender' => $formRender,
]) ?>

<div class="form-group">
    <?= $formRender->input('save', 'submit') ?>
</div>

<?= $formRender->endFrom() ?>
