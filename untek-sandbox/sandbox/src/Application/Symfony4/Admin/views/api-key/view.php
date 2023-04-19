<?php

/**
 * @var $baseUri string
 * @var $this View
 * @var $entity EntityIdInterface
 */

use Untek\Core\Text\Helpers\TextHelper;
use Untek\Sandbox\Sandbox\Application\Domain\Entities\ApiKeyEntity;

use Untek\Component\I18Next\Facades\I18Next;
use Untek\Model\Entity\Interfaces\EntityIdInterface;
use Untek\Component\Web\Controller\Helpers\ActionHelper;
use Untek\Component\Web\View\Application\Services\View;
use Untek\Component\Web\TwBootstrap\Widgets\Detail\DetailWidget;
use Untek\Component\Web\TwBootstrap\Widgets\Format\Formatters\ActionFormatter;
use Untek\Component\Web\TwBootstrap\Widgets\Format\Formatters\LinkFormatter;

$attributes = [
    [
        'label' => 'ID',
        'attributeName' => 'id',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.applicationId'),
        'attributeName' => 'application.title',
        'sort' => true,
        'formatter' => [
            'class' => LinkFormatter::class,
            'linkAttribute' => 'application.id',
            'uri' => '/application/application/view',
        ],
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.value'),
//        'attributeName' => 'value',
        'value' => function(ApiKeyEntity $apiKeyEntity) {
            return TextHelper::mask($apiKeyEntity->getValue(), 3);
        },
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.created_at'),
        'attributeName' => 'createdAt',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.expired_at'),
        'attributeName' => 'expiredAt',
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
            <?= ActionHelper::generateUpdateAction($entity, $baseUri, ActionHelper::TYPE_BUTTON) ?>
            <?= ActionHelper::generateDeleteAction($entity, $baseUri, ActionHelper::TYPE_BUTTON) ?>
        </div>

    </div>
</div>
