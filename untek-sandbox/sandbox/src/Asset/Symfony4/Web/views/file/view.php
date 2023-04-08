<?php

/**
 * @var $baseUri string
 * @var $this View
 * @var $entity EntityIdInterface
 */

use Untek\Lib\Components\Byte\Helpers\ByteSizeFormatHelper;
use Untek\Lib\Web\Html\Helpers\Html;
use Untek\Component\I18Next\Facades\I18Next;
use Untek\Model\Entity\Interfaces\EntityIdInterface;
use Untek\Lib\Web\Controller\Helpers\ActionHelper;
use Untek\Lib\Web\View\Libs\View;
use Untek\Lib\Web\TwBootstrap\Widgets\Detail\DetailWidget;
use Untek\Lib\Web\TwBootstrap\Widgets\Format\Formatters\LinkFormatter;
use Untek\Sandbox\Sandbox\Asset\Domain\Entities\FileEntity;

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
