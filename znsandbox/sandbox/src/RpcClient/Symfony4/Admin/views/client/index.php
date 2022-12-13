<?php

/**
 * @var $this \ZnLib\Web\View\Libs\View
 * @var $formView FormView|AbstractType[]
 * @var $formRender \ZnLib\Web\Form\Libs\FormRender
 * @var $dataProvider DataProvider
 * @var $baseUri string
 * @var $rpcResponseEntity \ZnFramework\Rpc\Domain\Entities\RpcResponseEntity
 * @var $rpcRequestEntity \ZnFramework\Rpc\Domain\Entities\RpcRequestEntity
 * @var $favoriteEntity \ZnSandbox\Sandbox\RpcClient\Domain\Entities\FavoriteEntity | null
 * @var $favoriteCollection \ZnCore\Collection\Interfaces\Enumerable | \ZnSandbox\Sandbox\RpcClient\Domain\Entities\FavoriteEntity[]
 * @var $historyCollection \ZnCore\Collection\Interfaces\Enumerable | \ZnSandbox\Sandbox\RpcClient\Domain\Entities\FavoriteEntity[]
 */

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;
use ZnLib\Web\Html\Helpers\Url;
use ZnDomain\DataProvider\Libs\DataProvider;
use ZnSandbox\Sandbox\RpcClient\Domain\Entities\ApiKeyEntity;

$activeTab = 'favorite';
foreach ($historyCollection as $favoriteEntityItem) {
    if ($favoriteEntity && ($favoriteEntity->getId() == $favoriteEntityItem->getId())) {
        $activeTab = 'history';
    }
}
//dd($this->translate('core', 'action.send'));
?>

<div class="row">
    <div class="col-lg-8">

        <?= $this->renderFile(
            __DIR__ . '/block/form.php', [
            'formRender' => $formRender,
            'baseUri' => $baseUri,
        ]) ?>

        <?= $this->renderFile(
            __DIR__ . '/block/transport.php', [
            'rpcResponseEntity' => $rpcResponseEntity,
            'rpcRequestEntity' => $rpcRequestEntity,
        ]) ?>

    </div>
    <div class="col-lg-4">

        <ul class="nav nav-tabs mb-3" id="collection-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link <?= $activeTab == 'favorite' ? 'active' : '' ?>" id="collection-favorite-tab"
                   data-toggle="pill" href="#collection-favorite"
                   role="tab" aria-controls="collection-favorite" aria-selected="true">
                    favorite
                    <span class="badge badge-primary badge-pill"><?= $favoriteCollection->count() ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $activeTab == 'history' ? 'active' : '' ?>" id="collection-history-tab"
                   data-toggle="pill" href="#collection-history" role="tab"
                   aria-controls="collection-history" aria-selected="false">
                    history
                    <span class="badge badge-primary badge-pill"><?= $historyCollection->count() ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="collection-tool-tab"
                   data-toggle="pill" href="#collection-tool" role="tab"
                   aria-controls="collection-tool" aria-selected="false">
                    tool
                </a>
            </li>
        </ul>

        <div class="tab-content" id="collection-tabContent">
            <div class="tab-pane fade <?= $activeTab == 'favorite' ? 'active show' : '' ?>" id="collection-favorite"
                 role="tabpanel"
                 aria-labelledby="collection-favorite-tab">
                <?= $this->renderFile(
                    __DIR__ . '/block/collection.php', [
                    'baseUri' => $baseUri,
                    'favoriteEntity' => $favoriteEntity,
                    'collection' => $favoriteCollection,
                ]) ?>
            </div>
            <div class="tab-pane fade <?= $activeTab == 'history' ? 'active show' : '' ?>" id="collection-history"
                 role="tabpanel" aria-labelledby="collection-history-tab">
                <?= $this->renderFile(
                    __DIR__ . '/block/collection.php', [
                    'baseUri' => $baseUri,
                    'favoriteEntity' => $favoriteEntity,
                    'collection' => $historyCollection,
                ]) ?>
                <a class="btn btn-primary mt-3" href="<?= $this->url('rpc-client/request/clear-history') ?>" role="button">
                    Clear
                </a>
            </div>
            <div class="tab-pane fade <?= $activeTab == 'tool' ? 'active show' : '' ?>" id="collection-tool"
                 role="tabpanel" aria-labelledby="collection-tool-tab">
                <a class="btn btn-primary" href="<?= $this->url('rpc-client/request/import-from-routes') ?>" role="button">
                    Import from routes
                </a>
                <a class="btn btn-primary" href="<?= $this->url('rpc-client/request/all-routes') ?>" role="button">
                    Show all routes
                </a>
            </div>
        </div>

    </div>
</div>
