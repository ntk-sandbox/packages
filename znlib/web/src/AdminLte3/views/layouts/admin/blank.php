<?php

/**
 * @var array $menuConfigFile
 * @var View $this
 * @var string $content
 */

use Untek\Lib\Web\AdminApp\Assets\AdminAppAsset;
use Untek\Lib\Web\Layout\Widgets\Script\ScriptWidget;
use Untek\Lib\Web\Layout\Widgets\Style\StyleWidget;
use Untek\Lib\Web\View\Libs\View;
use Untek\Lib\Web\Widget\Widgets\Toastr\ToastrWidget;

(new AdminAppAsset())->register($this);

//$this->registerCssFile('/static/css/footer.css');
//$this->registerCssFile('/static/css/site.css');

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?? '' ?></title>
    <?= StyleWidget::widget(['view' => $this]) ?>
</head>
<body>

<?= \Untek\Lib\Web\TwBootstrap\Widgets\Alert\AlertWidget::widget() ?>
<?= $content ?>

<?= ToastrWidget::widget(['view' => $this]) ?>
<?= StyleWidget::widget(['view' => $this]) ?>
<?= ScriptWidget::widget(['view' => $this]) ?>

</body>
</html>
