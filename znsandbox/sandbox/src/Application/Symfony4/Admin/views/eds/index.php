<?php

/**
 * @var $formView FormView|AbstractType[]
 * @var $dataProvider DataProvider
 * @var $baseUri string
 */

use Untek\Core\Text\Helpers\TextHelper;
use Untek\Sandbox\Sandbox\Application\Domain\Entities\ApiKeyEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;

use Untek\Lib\Web\Html\Helpers\Url;
use Untek\Lib\I18Next\Facades\I18Next;
use Untek\Domain\DataProvider\Libs\DataProvider;
use Untek\Lib\Web\TwBootstrap\Widgets\Collection\CollectionWidget;
use Untek\Lib\Web\TwBootstrap\Widgets\Format\Formatters\ActionFormatter;
use Untek\Lib\Web\TwBootstrap\Widgets\Format\Formatters\LinkFormatter;

$attributes = [
    [
        'label' => 'ID',
        'attributeName' => 'id',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.value'),
//        'attributeName' => 'value',
        'value' => function(ApiKeyEntity $apiKeyEntity) {
            return TextHelper::mask($apiKeyEntity->getValue(), 3);
        },
        'formatter' => [
            'class' => LinkFormatter::class,
            'uri' => $baseUri . '/view',
        ],
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.applicationId'),
        'attributeName' => 'application.title',
        'sort' => true,
        'sortAttribute' => 'application_id',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.created_at'),
        'attributeName' => 'createdAt',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.expired_at'),
        'attributeName' => 'expiredAt',
    ],
    [
        'formatter' => [
            'class' => ActionFormatter::class,
            'actions' => [
                'update',
                'delete',
            ],
            'baseUrl' => $baseUri,
        ],
    ],
];

?>

<div class="row">
    <div class="col-lg-12">
        <?= CollectionWidget::widget([
            'dataProvider' => $dataProvider,
            'attributes' => $attributes,
        ]) ?>
        <div class="float-left111">
            <a class="btn btn-primary" href="<?= Url::to([$baseUri . '/create']) ?>" role="button">
                <i class="fa fa-plus"></i>
                <?= I18Next::t('core', 'action.create') ?>
            </a>
        </div>
    </div>
</div>
