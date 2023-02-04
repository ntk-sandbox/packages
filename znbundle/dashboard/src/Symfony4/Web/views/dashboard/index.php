<?php

/**
 * @var View $this
 * @var array $widgetConfigList
 */

use Untek\Bundle\Dashboard\Symfony4\Widgets\Dashboard\DashboardWidget;
use Untek\Lib\I18Next\Facades\I18Next;
use Untek\Lib\Web\View\Libs\View;

//$this->title = I18Next::t('dashboard', 'main.title');

?>

<?= DashboardWidget::widget([
    'rowTemplate' => '<div class="row mb-4">{html}</div>',
    'items' => $widgetConfigList,
]) ?>
