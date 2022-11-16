<?php

/**
 * @var string $inputName
 * @var string $label
 * @var $value
 */

use ZnLib\Web\Html\Helpers\Html; ?>

<?= Html::input('text', $inputName, $value, [
    'class' => 'form-control',
    'placeholder' => $label,
]); ?>
