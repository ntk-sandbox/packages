<?php

/**
 * @var $formView FormView|AbstractType[]
 * @var $collection ValidationEntity[] | Enumerable
 * @var $baseUri string
 */

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;
use ZnBundle\Eav\Domain\Entities\ValidationEntity;
use ZnBundle\Eav\Domain\Enums\AttributeTypeEnum;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnLib\I18Next\Facades\I18Next;
use ZnLib\Components\Status\Enums\StatusEnum;
use ZnLib\Web\Html\Helpers\Url;
use ZnLib\Web\TwBootstrap\Widgets\Collection\CollectionWidget;
use ZnLib\Web\TwBootstrap\Widgets\Format\Formatters\ActionFormatter;
use ZnLib\Web\TwBootstrap\Widgets\Format\Formatters\Actions\UpdateAction;
use ZnLib\Web\TwBootstrap\Widgets\Format\Formatters\BooleanFormatter;
use ZnLib\Web\TwBootstrap\Widgets\Format\Formatters\EnumFormatter;
use ZnLib\Web\TwBootstrap\Widgets\Format\Formatters\LinkFormatter;

//dd($collection);

$attributes = [
    [
        'label' => 'ID',
        'attributeName' => 'id',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.title'),
        'attributeName' => 'attribute.title',
        'formatter' => [
            'class' => LinkFormatter::class,
            'linkAttribute' => 'attribute.id',
            'uri' => $baseUri . '/view',
        ],
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.name'),
        'attributeName' => 'attribute.name',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.type'),
        'attributeName' => 'attribute.type',
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
    /*[
        'label' => 'description',
        'attributeName' => 'description',
    ],
    [
        'label' => 'unit_id',
        'attributeName' => 'unit_id',
    ],*/
    [
        'label' => 'status',
        'attributeName' => 'status',
        'formatter' => [
            'class' => EnumFormatter::class,
            'enumClass' => StatusEnum::class,
        ],
    ],
    [
        'formatter' => [
            'class' => ActionFormatter::class,
            'actionDefinitions' => [
                'sortUp' => [
                    'class' => UpdateAction::class,
                    'icon' => 'fas fa-arrow-up',
                    'urlAction' => 'sort-up',
                    'title' => 'Up',
                ],
                'sortDown' => [
                    'class' => UpdateAction::class,
                    'icon' => 'fas fa-arrow-down',
                    'urlAction' => 'sort-down',
                    'title' => 'Down',
                ],
                'attach' => [
                    'class' => UpdateAction::class,
                    'icon' => 'fas fa-link',
                    'urlAction' => 'attach',
                    'title' => 'Attach',
                    'type' => 'success',
                ],
                'detach' => [
                    'class' => UpdateAction::class,
                    'icon' => 'fas fa-unlink',
                    'urlAction' => 'detach',
                    'title' => 'Detach',
                    'type' => 'danger',
                ],
            ],
            'actions' => [
                'sortUp',
                'sortDown',
                //'attach',
                //'detach',
                'update',
                'delete',
            ],
            'baseUrl' => '/eav/entity-attribute',
        ],
    ],
];

?>

<?= CollectionWidget::widget([
    'collection' => $collection,
    'attributes' => $attributes,
]) ?>
<div class="float-left111">
    <a class="btn btn-primary" href="<?= Url::to([$baseUri . '/create']) ?>" role="button">
        <i class="fa fa-plus"></i>
        <?= I18Next::t('core', 'action.create') ?>
    </a>
</div>
