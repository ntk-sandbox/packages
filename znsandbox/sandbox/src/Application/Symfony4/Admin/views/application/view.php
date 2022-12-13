<?php

/**
 * @var $baseUri string
 * @var $this View
 * @var $entity EntityIdInterface
 */

use ZnLib\Components\Status\Enums\StatusEnum;
use ZnLib\I18Next\Facades\I18Next;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnLib\Web\Controller\Helpers\ActionHelper;
use ZnLib\Web\View\Libs\View;
use ZnLib\Web\TwBootstrap\Widgets\Detail\DetailWidget;
use ZnLib\Web\TwBootstrap\Widgets\Format\Formatters\EnumFormatter;
use ZnLib\Web\TwBootstrap\Widgets\Format\Formatters\LinkFormatter;

$attributes = [
    [
        'label' => 'ID',
        'attributeName' => 'id',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.title'),
        'attributeName' => 'title',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.created_at'),
        'attributeName' => 'createdAt',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.status'),
        'attributeName' => 'statusId',
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

        <div class="float-left111">
            <a type="primary" class=" btn  btn-primary" href="<?= \ZnLib\Web\Html\Helpers\Url::to(['/application/api-key', 'filter[application_id]' => $entity->getId()]) ?>" title="View Key list" icon="fa fa fa-edit"><i class="fa fa fa-edit"></i> View Key list</a>
            <?= ActionHelper::generateUpdateAction($entity, $baseUri, ActionHelper::TYPE_BUTTON) ?>
            <?= ActionHelper::generateDeleteAction($entity, $baseUri, ActionHelper::TYPE_BUTTON) ?>
        </div>

    </div>
</div>
