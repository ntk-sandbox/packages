<?php

/**
 * @var $baseUri string
 * @var $this View
 * @var $entity EntityIdInterface
 */

use Untek\Bundle\Storage\Domain\Entities\FileEntity;
use Untek\Lib\Components\Byte\Helpers\ByteSizeFormatHelper;
use Untek\Component\Web\Html\Helpers\Html;
use Untek\Component\I18Next\Facades\I18Next;
use Untek\Model\Entity\Interfaces\EntityIdInterface;
use Untek\Component\Web\Controller\Helpers\ActionHelper;
use Untek\Component\Web\HtmlRender\Application\Services\View;
use Untek\Component\Web\TwBootstrap\Widgets\Detail\DetailWidget;
use Untek\Component\Web\TwBootstrap\Widgets\Format\Formatters\LinkFormatter;

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
