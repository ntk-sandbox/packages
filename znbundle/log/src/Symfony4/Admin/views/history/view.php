<?php

/**
 * @var $baseUri string
 * @var $this View
 * @var $entity EntityIdInterface
 */

use ZnLib\I18Next\Facades\I18Next;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnLib\Web\View\Libs\View;
use ZnLib\Web\TwBootstrap\Widgets\Detail\DetailWidget;
use ZnLib\Web\TwBootstrap\Widgets\Format\Formatters\ArrayFormatter;
use ZnLib\Web\TwBootstrap\Widgets\Format\Formatters\LinkFormatter;

$attributes = [
    [
        'label' => 'ID',
        'attributeName' => 'id',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.message'),
        'attributeName' => 'message',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.level'),
        'attributeName' => 'level',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.level_name'),
        'attributeName' => 'level_name',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.channel'),
        'attributeName' => 'channel',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.createdAt'),
        'attributeName' => 'createdAt',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.extra'),
        'attributeName' => 'extra',
        'format' => 'html',
        'value' => function (\ZnBundle\Log\Domain\Entities\HistoryEntity $historyEntity) {
            $extra = json_encode($historyEntity->getExtra(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return '<pre>' . $extra . '</pre>';
        },
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.context'),
        'attributeName' => 'context',
        'format' => 'html',
        'value' => function (\ZnBundle\Log\Domain\Entities\HistoryEntity $historyEntity) {
            $context = json_encode($historyEntity->getContext(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return '<pre>' . str_replace('\n', PHP_EOL, $context) . '</pre>';
        },
    ],
];

?>

<div class="row">
    <div class="col-lg-12">

        <?= DetailWidget::widget([
            'entity' => $entity,
            'attributes' => $attributes,
        ]) ?>

    </div>
</div>
