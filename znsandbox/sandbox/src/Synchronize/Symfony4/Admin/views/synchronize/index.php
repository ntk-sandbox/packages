<?php

/**
 * @var \ZnCore\Collection\Interfaces\Enumerable | DiffCollectionEntity[] $diffCollection
 * @var \ZnLib\Web\View\Libs\View $this
 */

use ZnCore\Arr\Helpers\ArrayHelper;
use ZnLib\I18Next\Facades\I18Next;
use ZnSandbox\Sandbox\Synchronize\Domain\Entities\DiffCollectionEntity;

$this->title = I18Next::t('synchronize', 'synchronize.title');

function printTitle(DiffCollectionEntity $diffCollectionEntity, array $row): string
{
    $titleAttributes = $diffCollectionEntity->getConfig()->getTitleAttributes();
    if ($titleAttributes) {
        $row = ArrayHelper::extractByKeys($row, $titleAttributes);
        $itemsHtml = '';
        foreach ($row as $name => $value) {
            $itemsHtml .= "<li>$name: <code>$value</code></li>";
        }
        //$itemsHtml = StringHelper::implode($row, '<li>', '</li>');


        return "<small><ul>$itemsHtml</ul></small>";
//        return '<span class="badge badge-success">' . implode('</span> &nbsp; <span class="badge badge-success">', $row) . '</span>';
    } else {
        return json_encode($row, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}

?>

<div class="import-data">

    <?php foreach ($diffCollection as $diffCollectionEntity): ?>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <?= $diffCollectionEntity->getTableName() ?>
                </h5>
            </div>

            <?php if ($diffCollectionEntity->isEmpty()): ?>
                <div class="card-body">
                    <p class="card-text text-muted">
                        Empty
                    </p>
                </div>
            <?php else: ?>
                <ul class="list-group list-group-flush">
                    <?php foreach ($diffCollectionEntity->getForDelete() as $row): ?>
                        <li class="list-group-item list-group-item-danger">
                            <?= printTitle($diffCollectionEntity, $row) ?>
                        </li>
                    <?php endforeach; ?>
                    <?php foreach ($diffCollectionEntity->getForInsert() as $row): ?>
                        <li class="list-group-item list-group-item-success">
                            <?= printTitle($diffCollectionEntity, $row) ?>
                        </li>
                    <?php endforeach; ?>
                    <?php foreach ($diffCollectionEntity->getDiff() as $diffAttributeEntity): ?>
                        <li class="list-group-item list-group-item-warning">
                            <?= $diffAttributeEntity->getIndex() ?>
                            <ul>
                                <?php foreach ($diffAttributeEntity->getAttributes() as $attributeEntity): ?>
                                    <li>
                                        <small>
                                            <?= $attributeEntity->getName() ?>:
                                            <span class="text-danger">
                                            <?= json_encode($attributeEntity->getFromValue(), JSON_UNESCAPED_UNICODE) ?>
                                        </span>
                                            >>
                                            <span class="text-success">
                                            <?= json_encode($attributeEntity->getToValue(), JSON_UNESCAPED_UNICODE) ?>
                                        </span>

                                        </small>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

        </div>

    <?php endforeach; ?>

    <form method="post" action="<?= $this->urlGenerator->generate('synchronize/synchronize/sync') ?>">
        <input type="submit" class="btn btn-primary" value="<?= I18Next::t('core', 'action.send') ?>"/>
    </form>

</div>
