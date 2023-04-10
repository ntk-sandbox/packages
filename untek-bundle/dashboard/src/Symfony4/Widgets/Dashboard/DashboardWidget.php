<?php

namespace Untek\Bundle\Dashboard\Symfony4\Widgets\Dashboard;

use Untek\Bundle\Dashboard\Symfony4\Widgets\Dashboard\Helpers\DashboardHelper;

use Untek\Core\Text\Helpers\TemplateHelper;
use Untek\Component\Web\Widget\Base\BaseWidget2;

class DashboardWidget extends BaseWidget2
{

    public $items;
    public $labelTemplate = '<h3>{html}</h3>';
    public $rowTemplate = '<div class="row">{html}</div>';
    public $colTemplate = '<div class="col">{html}</div>';

    private function generatePanel($panel): ?string
    {
        $counterList = DashboardHelper::prepareItems($panel['items']);
        if (empty($counterList)) {
            return null;
        }
        $perLine = $panel['perLine'] ?? 1;
        $tree = DashboardHelper::toTree($counterList, $perLine);
        $html = $this->renderPanel($tree);
        if (!empty($panel['label'])) {
            $title = TemplateHelper::render($this->labelTemplate, ['html' => $panel['label']]);
            $html = $title . $html;
        }
        return $html;
    }

    private function renderPanel(array $tree): string
    {
        $html = '';
        foreach ($tree as $lineItems) {
            $rowHtml = '';
            foreach ($lineItems as $widgetHtml) {
                $rowHtml .= TemplateHelper::render($this->colTemplate, ['html' => $widgetHtml]);
            }
            $html .= TemplateHelper::render($this->rowTemplate, ['html' => $rowHtml]);
        }
        return $html;
    }

    public function run(): string
    {
        $all = [];
        $items = $this->items;
        $items = DashboardHelper::prepareItems($items);
        foreach ($items as $index => $panel) {
            $panelHtml = $this->generatePanel($panel);
            if (!empty($panelHtml)) {
                $all[] = $panelHtml;
            }
        }
        return implode('', $all);
    }
}
