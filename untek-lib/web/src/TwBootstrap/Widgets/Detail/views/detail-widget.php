<?php

/**
 * @var View $this
 * @var AttributeEntity[] $attributes
 * @var string $tableClass
 * @var FormatEncoder $formatter
 */

use Untek\Lib\I18Next\Facades\I18Next;
use Untek\Lib\Web\View\Libs\View;
use Untek\Lib\Web\TwBootstrap\Widgets\Format\Entities\AttributeEntity;
use Untek\Lib\Web\TwBootstrap\Widgets\Format\Libs\FormatEncoder;

?>

<table class="<?= $tableClass ?>">
    <thead>
    <tr>
        <th><?= I18Next::t('core', 'main.title') ?></th>
        <th><?= I18Next::t('core', 'main.value') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($attributes as $attributeEntity):
        //$value = $attributeEntity->getValue();
        $value = $formatter->encode($attributeEntity);
        ?>
        <tr>
            <th><?= $attributeEntity->getLabel() ?></th>
            <td><?= $value ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
