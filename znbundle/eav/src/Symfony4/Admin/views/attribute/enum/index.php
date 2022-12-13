<?php

/**
 * @var $formView FormView|AbstractType[]
 * @var $collection ValidationEntity[] | Enumerable
 * @var $baseUri string
 */

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;
use ZnBundle\Eav\Domain\Entities\ValidationEntity;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnLib\I18Next\Facades\I18Next;
use ZnLib\Web\Html\Helpers\Url;
use ZnLib\Web\TwBootstrap\Widgets\Collection\CollectionWidget;
use ZnLib\Web\TwBootstrap\Widgets\Format\Formatters\ActionFormatter;
use ZnLib\Web\TwBootstrap\Widgets\Format\Formatters\LinkFormatter;

$attributes = [
    [
        'label' => 'ID',
        'attributeName' => 'id',
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.name'),
        'attributeName' => 'name',
        'sort' => true,
        'formatter' => [
            'class' => LinkFormatter::class,
            'uri' => $baseUri . '/view',
        ],
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.title'),
        'attributeName' => 'title',
        'sort' => true,
        'formatter' => [
            'class' => LinkFormatter::class,
            'uri' => $baseUri . '/view',
        ],
    ],
    [
        'label' => I18Next::t('core', 'main.attribute.sort'),
        'attributeName' => 'sort',
        'sort' => true,
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
