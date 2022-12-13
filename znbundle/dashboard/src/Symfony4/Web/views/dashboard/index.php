<?php

/**
 * @var View $this
 * @var array $widgetConfigList
 */

use ZnBundle\Dashboard\Symfony4\Widgets\Dashboard\DashboardWidget;
use ZnLib\I18Next\Facades\I18Next;
use ZnLib\Web\View\Libs\View;

//$this->title = I18Next::t('dashboard', 'main.title');

?>

<?= DashboardWidget::widget([
    'rowTemplate' => '<div class="row mb-4">{html}</div>',
    'items' => $widgetConfigList,
]) ?>
