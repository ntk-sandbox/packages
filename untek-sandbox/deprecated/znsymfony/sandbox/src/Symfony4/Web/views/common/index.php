<?php

/**
 * @var array $dumps
 * @var View $this
 * @var string $content
 * @var $formView FormView|AbstractType[]
 */

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;
use Untek\Component\Web\View\Application\Services\View;

?>

<?php
if(isset($formView)) {
    echo $this->renderFile(
        __DIR__ . '/form.php', [
        'formView' => $formView,
    ]);
}
?>

<?= $content ?>

<?php
if(isset($dumps)) {
    foreach ($dumps as $dump) {
        dump($dump);
    }
}
?>