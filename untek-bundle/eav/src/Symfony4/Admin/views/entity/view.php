<?php

/**
 * @var $baseUri string
 * @var $this View
 * @var $entity EntityEntity
 */

use Untek\Bundle\Eav\Domain\Entities\EntityEntity;
use Untek\Lib\Components\Status\Enums\StatusEnum;
use Untek\Component\I18Next\Facades\I18Next;
use Untek\Model\Entity\Interfaces\EntityIdInterface;
use Untek\Component\Web\Controller\Helpers\ActionHelper;
use Untek\Component\Web\View\Libs\View;
use Untek\Component\Web\TwBootstrap\Widgets\Detail\DetailWidget;
use Untek\Component\Web\TwBootstrap\Widgets\Format\Formatters\EnumFormatter;
use Untek\Component\Web\TwBootstrap\Widgets\Format\Formatters\LinkFormatter;

//dd($entity);

$attributes = [
    [
        'label' => 'ID',
        'attributeName' => 'id',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.title'),
        'attributeName' => 'title',
        /*'formatter' => [
            'class' => LinkFormatter::class,
            'uri' => $baseUri . '/view',
        ],*/
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.name'),
        'attributeName' => 'name',
    ],
    [
        'label' => 'category',
        'attributeName' => 'category.title',
        'formatter' => [
            'class' => LinkFormatter::class,
            'uri' => '/eav/category/view',
        ],
    ],
    [
        'label' => 'handler',
        'attributeName' => 'handler',
    ],
    [
        'label' => 'status',
        'attributeName' => 'status',
        'formatter' => [
            'class' => EnumFormatter::class,
            'enumClass' => StatusEnum::class,
        ],
    ],
];

?>

<div class="row">
    <div class="col-lg-12">

        <?= DetailWidget::widget([
            'entity' => $entity,
            'attributes' => $attributes,
        ]) ?>

        <div class="float-left111 mb-3">
            <?= ActionHelper::generateUpdateAction($entity, $baseUri, ActionHelper::TYPE_BUTTON) ?>
            <?= ActionHelper::generateDeleteAction($entity, $baseUri, ActionHelper::TYPE_BUTTON) ?>
        </div>

        <div class="mb-3">
            <h3>Attributes</h3>
            <?= $this->renderFile(
                __DIR__ . '/attribute/index.php', [
                'collection' => $entity->getAttributesTie(),
                'baseUri' => '/eav/attribute',
            ]); ?>
        </div>

    </div>
</div>
