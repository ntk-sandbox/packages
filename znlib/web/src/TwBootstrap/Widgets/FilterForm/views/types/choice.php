<?php

/**
 * @var string $inputName
 * @var string $label
 * @var $value
 * @var array $options
 */


use ZnLib\Web\Html\Helpers\Html; ?>

<?= Html::dropDownList($inputName, $value, $options, [
    'class' => 'form-control select2',
]); ?>
