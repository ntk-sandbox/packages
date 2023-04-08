<?php

/**
 * @var $baseUri string
 * @var $this View
 * @var $entity AttributeEntity
 */

use Untek\Bundle\Eav\Domain\Entities\AttributeEntity;
use Untek\Bundle\Eav\Domain\Enums\AttributeTypeEnum;
use Untek\Lib\Components\Status\Enums\StatusEnum;
use Untek\Component\I18Next\Facades\I18Next;
use Untek\Lib\Web\Controller\Helpers\ActionHelper;
use Untek\Lib\Web\View\Libs\View;
use Untek\Lib\Web\TwBootstrap\Widgets\Detail\DetailWidget;
use Untek\Lib\Web\TwBootstrap\Widgets\Format\Formatters\BooleanFormatter;
use Untek\Lib\Web\TwBootstrap\Widgets\Format\Formatters\EnumFormatter;
use Untek\Lib\Web\TwBootstrap\Widgets\Format\Formatters\LinkFormatter;

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
        'label' => I18Next::t('core', 'main.attribute.type'),
        'attributeName' => 'type',
        'formatter' => [
            'class' => EnumFormatter::class,
            'enumClass' => AttributeTypeEnum::class,
        ],
    ],
    [
        'label' => 'is_required',
        'attributeName' => 'is_required',
        'formatter' => [
            'class' => BooleanFormatter::class,
        ],
    ],
    [
        'label' => 'default',
        'attributeName' => 'default',
    ],
    [
        'label' => 'description',
        'attributeName' => 'description',
    ],
    [
        'label' => 'unit_id',
        'attributeName' => 'unit_id',
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

        <div class="mb-3">
            <?= ActionHelper::generateUpdateAction($entity, $baseUri, ActionHelper::TYPE_BUTTON) ?>
            <?= ActionHelper::generateDeleteAction($entity, $baseUri, ActionHelper::TYPE_BUTTON) ?>
        </div>

        <div class="mb-3">
            <h3>Validation rules</h3>
            <?= $this->renderFile(
                __DIR__ . '/validation/index.php', [
                'collection' => $entity->getRules(),
                'baseUri' => '/eav/validation',
            ]); ?>
        </div>

        <div class="mb-3">
            <h3>Enums</h3>
            <?php if($entity->getType() == AttributeTypeEnum::ENUM): ?>
                <?= $this->renderFile(
                    __DIR__ . '/enum/index.php', [
                    'collection' => $entity->getEnums(),
                    'baseUri' => '/eav/enum',
                ]); ?>
            <?php else: ?>
                <div class="alert alert-secondary" role="alert">
                    Type is not enum
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>
