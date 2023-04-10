<?php

namespace Untek\Bundle\Dashboard\Symfony4\Widgets\Dashboard\Helpers;

use Untek\Component\Web\Menu\Domain\Helpers\MenuHelper;
use Untek\Core\Instance\Helpers\ClassHelper;
use Untek\Component\Web\Widget\Base\BaseWidget2;

class DashboardHelper
{

    public static function prepareItems(array $items): array
    {
        $items = MenuHelper::prepareModule($items);
        $items = MenuHelper::filterByVisible($items);
        $items = MenuHelper::prepareLabel($items);
        return $items;
    }

    private static function generateWidget(array $widgetConfig): ?string
    {
        /** @var BaseWidget2 $widgetInstance */
        $widgetInstance = ClassHelper::createObject($widgetConfig);
        $widgetHtml = $widgetInstance->run();
        $widgetHtml = trim($widgetHtml);
        return $widgetHtml;
    }

    private static function generateWidgets(array $widgetConfigList): array
    {
        $widgetList = [];
        foreach ($widgetConfigList as $widgetConfig) {
            $widgetHtml = self::generateWidget($widgetConfig);
            if (!empty($widgetHtml)) {
                $widgetList[] = $widgetHtml;
            }
        }
        return $widgetList;
    }

    private static function getPerLineCont(int $countWidgets, int $perLine): int
    {
        $countLines = (int)ceil($countWidgets / $perLine);
        return (int)ceil($countWidgets / $countLines);
    }

    public static function toTree(array $widgetConfigList, int $perLine): array
    {
        $widgetList = self::generateWidgets($widgetConfigList);
        $countWidgets = count($widgetConfigList);
        $perLine = self::getPerLineCont($countWidgets, $perLine);
        $tree = [];
        foreach ($widgetList as $index => $widgetHtml) {
            $line = floor($index / $perLine);
            $tree[$line][] = $widgetHtml;
        }
        return $tree;
    }
}
