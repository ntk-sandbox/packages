<?php

/**
 * @var $this \Untek\Component\Web\View\Application\Services\View
 * @var $baseUri string
 * @var $favoriteEntity \Untek\Sandbox\Sandbox\RpcClient\Domain\Entities\FavoriteEntity | null
 * @var $collection \Untek\Core\Collection\Interfaces\Enumerable | \Untek\Sandbox\Sandbox\RpcClient\Domain\Entities\FavoriteEntity[]
 */

use Untek\Sandbox\Sandbox\RpcClient\Domain\Entities\ApiKeyEntity;

/*$map = [];
foreach ($collection as $favoriteEntityItem) {
    $methodItems = explode('.', $favoriteEntityItem->getMethod());
    if(count($methodItems) > 1) {
        $groupName = $methodItems[0];
    } else {
        $groupName = 'other';
    }
    $map[$groupName][] = $favoriteEntityItem;
}
ksort($map);*/

$map = \Untek\Sandbox\Sandbox\RpcClient\Domain\Helpers\FavoriteHelper::generateFavoriteCollectionToMap($collection);

?>

<?php foreach ($map as $groupName => $favoriteEntityItems): ?>
<?php sort($favoriteEntityItems); ?>
<h5 class="mt-3">
    <?= $groupName ?>
</h5>
<div class="list-group">
    <?php foreach ($favoriteEntityItems as $favoriteEntityItem): ?>
        <?= $this->renderFile(
            __DIR__ . '/item.php', [
        'baseUri' => $baseUri,
        'favoriteEntity' => $favoriteEntity,
        'favoriteEntityItem' => $favoriteEntityItem,
    ]) ?>
    <?php endforeach; ?>
</div>
<?php endforeach; ?>
