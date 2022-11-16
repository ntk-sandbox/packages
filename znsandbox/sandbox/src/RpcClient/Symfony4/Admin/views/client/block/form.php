<?php

/**
  @var $formView FormView|AbstractType[]
 * @var $formRender FormRender
 */

use ZnLib\Web\Form\Libs\FormRender;

//$formRender->addFormOption('autocomplete', 'off');

?>

<?= $formRender->errors() ?>

<?= $formRender->beginFrom() ?>

<ul class="nav nav-tabs mb-2" id="form-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="form-home-tab" data-toggle="pill" href="#form-home" role="tab"
           aria-controls="form-home" aria-selected="true">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="form-body-tab" data-toggle="pill" href="#form-body" role="tab" aria-controls="form-body"
           aria-selected="false">body</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="form-meta-tab" data-toggle="pill" href="#form-meta" role="tab" aria-controls="form-meta"
           aria-selected="false">meta</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="form-description-tab" data-toggle="pill" href="#form-description" role="tab"
           aria-controls="form-description" aria-selected="false">description</a>
    </li>
</ul>

<div class="tab-content" id="form-tabContent">
    <div class="tab-pane fade active show" id="form-home" role="tabpanel" aria-labelledby="form-home-tab">

        <div class="form-group required has-error">
            <?= $formRender->label('version') ?>
            <?= $formRender->input('version') ?>
            <?= $formRender->hint('version') ?>
        </div>

        <div class="form-group required has-error">
            <?= $formRender->label('method') ?>
            <?= $formRender->input('method') ?>
            <?= $formRender->hint('method') ?>
        </div>

        <div class="form-group required has-error">
            <?= $formRender->label('authBy') ?>
            <?= $formRender->input('authBy') ?>
            <?= $formRender->hint('authBy') ?>
        </div>
    </div>
    <div class="tab-pane fade" id="form-body" role="tabpanel" aria-labelledby="form-body-tab">
        <div class="form-group required has-error">
            <?= $formRender->label('body') ?>
            <?= $formRender->input('body', null, [
                'style' => "font-size: 12px; font-family:monospace;",
                'rows' => 6,
            ]) ?>
            <?= $formRender->hint('body') ?>
        </div>
    </div>
    <div class="tab-pane fade" id="form-meta" role="tabpanel" aria-labelledby="form-meta-tab">
        <div class="form-group required has-error">
            <?= $formRender->label('meta') ?>
            <?= $formRender->input('meta', null, [
                'style' => "font-size: 12px; font-family:monospace;",
                'rows' => 6,
            ]) ?>
            <?= $formRender->hint('meta') ?>
        </div>
    </div>
    <div class="tab-pane fade" id="form-description" role="tabpanel" aria-labelledby="form-description-tab">
        <div class="form-group required has-error">
            <?= $formRender->label('description') ?>
            <?= $formRender->input('description', null, [
                'style' => "font-size: 12px; font-family:monospace;",
                'rows' => 6,
            ]) ?>
            <?= $formRender->hint('description') ?>
        </div>
    </div>
</div>

<div class="form-group">
    <?= $formRender->input('save', 'submit', ['class' => 'btn btn-default']) ?>
    <?= $formRender->input('persist', 'submit') ?>
    <?= $formRender->input('delete', 'submit', ['class' => 'btn btn-danger']) ?>
</div>

<?= $formRender->endFrom() ?>
