<?php

/**
 * @var $baseUri string
 * @var $this View
 * @var $entity EntityIdInterface
 */

use ZnLib\Components\Byte\Helpers\ByteSizeFormatHelper;
use ZnLib\Web\Html\Helpers\Html;
use ZnLib\I18Next\Facades\I18Next;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnLib\Web\Controller\Helpers\ActionHelper;
use ZnLib\Web\View\Libs\View;
use ZnLib\Web\TwBootstrap\Widgets\Detail\DetailWidget;
use ZnLib\Web\TwBootstrap\Widgets\Format\Formatters\LinkFormatter;
use ZnSandbox\Sandbox\Asset\Domain\Entities\FileEntity;

$attributes = [
    [
        'label' => 'ID',
        'attributeName' => 'id',
    ],
    [
        'label' => I18Next::t('storage', 'file.attribute.name'),
        'attributeName' => 'name',
        'sort' => true,
        'formatter' => [
            'class' => LinkFormatter::class,
            'uri' => '/storage/file/view',
        ],
    ],
    [
        'label' => I18Next::t('storage', 'file.attribute.extension'),
        'attributeName' => 'extension',
    ],
    [
        'label' => I18Next::t('storage', 'file.attribute.size'),
        //'attributeName' => 'size',
        'value' => function (FileEntity $entity) {
            return ByteSizeFormatHelper::sizeFormat($entity->getSize());
        },
    ],
    [
        'label' => I18Next::t('storage', 'file.attribute.link'),
        'format' => 'html',
        'value' => function (FileEntity $entity) {
            $path = $entity->getUri();
            return Html::a($path, $path, ['target' => '_blank']);
        },
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.created_at'),
        'attributeName' => 'created_at',
        'sort' => true,
    ],
//    [
//        'label' => 'ID',
//        'attributeName' => 'id',
//    ],
//    [
//        'label' => I18Next::t('core', 'main.attribute.title'),
//        'attributeName' => 'name',
//    ],
//    [
//        'label' => I18Next::t('core', 'main.attribute.created_at'),
//        'attributeName' => 'createdAt',
//    ],
//    [
//        'label' => I18Next::t('core', 'main.attribute.status'),
//        'attributeName' => 'statusId',
//        'formatter' => [
//            'class' => EnumFormatter::class,
//            'enumClass' => StatusEnum::class,
//        ],
//    ],
];

?>

<div class="row">
    <div class="col-lg-12">

        <?= DetailWidget::widget([
            'entity' => $entity,
            'attributes' => $attributes,
        ]) ?>

        <div class="float-left111">
            <?= ActionHelper::generateUpdateAction($entity, $baseUri, ActionHelper::TYPE_BUTTON) ?>
            <?= ActionHelper::generateDeleteAction($entity, $baseUri, ActionHelper::TYPE_BUTTON) ?>
        </div>

    </div>
</div>
