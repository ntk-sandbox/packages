<?php

/**
 * @var View $this
 * @var string $baseUrl
 * @var array $queryParams
 * @var AttributeEntity[] $attributes
 */

use Untek\Lib\Web\TwBootstrap\Widgets\Format\Entities\AttributeEntity;
use Untek\Lib\Web\Html\Helpers\HtmlHelper;
use Untek\Lib\Web\View\Libs\View;

?>

<tr>
    <?php foreach ($attributes as $attributeEntity): ?>
        <th>
            <?php
            if ($attributeEntity->getSortAttribute()) {
                echo \Untek\Lib\Web\TwBootstrap\Widgets\Collection\Helpers\CollectionWidgetHelper::sortByField($attributeEntity->getLabel(), $attributeEntity->getSortAttribute(), $baseUrl, $queryParams);
            } else {
                echo $attributeEntity->getLabel();
            }
            ?>
        </th>
    <?php endforeach; ?>
</tr>
