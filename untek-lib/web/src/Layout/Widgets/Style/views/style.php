<?php

/**
 * @var View $this
 * @var \Untek\Component\Web\View\Resources\Css $css
 */

use Untek\Component\Web\View\Libs\View;

foreach ($css->getFiles() as $item) {
    $options = $item['options'];
    $options['rel'] = 'stylesheet';
    $options['href'] = $item['file'];
    if (getenv('ASSET_FORCE_RELOAD') ?: false) {
        $options['href'] .= '?timestamp=' . time();
    }
    echo \Untek\Component\Web\Html\Helpers\Html::tag('link', '', $options);
}
$css->resetFiles();
?>
<style>
    <?= $css->getCode() ?>
</style>
<?php
$css->resetCode();

?>
