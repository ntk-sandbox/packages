<?php

/**
 * @var $this \Untek\Lib\Web\View\Libs\View
 * @var $formView FormView|AbstractType[]
 * @var $formRender \Untek\Lib\Web\Form\Libs\FormRender
 * @var $dataProvider DataProvider
 * @var $baseUri string
 * @var $rpcResponseEntity \Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity
 * @var $rpcRequestEntity \Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity
 * @var $favoriteEntity \Untek\Sandbox\Sandbox\RpcClient\Domain\Entities\FavoriteEntity | null
 * @var $favoriteCollection Enumerable | \Untek\Sandbox\Sandbox\RpcClient\Domain\Entities\FavoriteEntity[]
 * @var $historyCollection Enumerable | \Untek\Sandbox\Sandbox\RpcClient\Domain\Entities\FavoriteEntity[]
 * @var $methodCollectionIndexed Enumerable | \Untek\Framework\Rpc\Domain\Entities\MethodEntity[]
 * @var $routeMethodList array | string[]
 * @var $missingMethodList array | string[]
 */

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;
use Untek\Lib\Web\Html\Helpers\Url;
use Untek\Model\DataProvider\Libs\DataProvider;
use Untek\Sandbox\Sandbox\RpcClient\Domain\Entities\ApiKeyEntity;
use Untek\Core\Collection\Interfaces\Enumerable;


$favCollection = [];
foreach ($methodCollectionIndexed as $methodEntity) {
//    if(in_array($methodEntity->getMethodName(), $missingMethodList) ) {
        $favEntity = new \Untek\Sandbox\Sandbox\RpcClient\Domain\Entities\FavoriteEntity();
        $favEntity->setMethod($methodEntity->getMethodName());
        $favEntity->setDescription($methodEntity->getTitle());
        if($methodEntity->getIsVerifyAuth()) {
            $favEntity->setAuthBy(1);
        }
        $favCollection[] = $favEntity;
//    }
}
$map = \Untek\Sandbox\Sandbox\RpcClient\Domain\Helpers\FavoriteHelper::generateFavoriteCollectionToMap($favCollection);

/**
 * @var $favoriteEntityItem \Untek\Sandbox\Sandbox\RpcClient\Domain\Entities\FavoriteEntity
 */

?>

<?= $formRender->errors() ?>

<?= $formRender->beginFrom() ?>

<h3>
    Missing method list
    <span class="badge badge-pill badge-secondary"><?= count($favCollection) ?></span>
</h3>

<?php foreach ($map as $groupName => $favoriteEntityItems): ?>
    <?php sort($favoriteEntityItems); ?>
    <h5 class="mt-3">
        <?= $groupName ?>
        <span class="badge badge-pill badge-secondary"><?= count($favoriteEntityItems) ?></span>
    </h5>
    <div class="list-group">
        <?php foreach ($favoriteEntityItems as $favoriteEntityItem): ?>
            <span href111="/rpc-client/request?id=9" class="list-group-item list-group-item-action " style="border: 1px solid rgba(0,0,0,.125) !important; padding: 0.3rem 0.7rem;">
                <div class="d-flex w-100 justify-content-between">
                    <small>
                        <?= $favoriteEntityItem->getMethod() ?>
                    </small>
                    <small class="text-muted111">
                        <?php if ($favoriteEntityItem->getBody()): ?>
                            <i class="fas fa-database align-middle" style="-color: Dodgerblue;" title="With body"></i>
                        <?php endif; ?>
                        <?php if ($favoriteEntityItem->getMeta()): ?>
                            <i class="fas fa-cog align-middle" style="-color: Mediumslateblue;" title="With meta"></i>
                        <?php endif; ?>

                        <?php if ($favoriteEntityItem->getAuthBy()): ?>
                            <i class="fas fa-user" title="Auth by"></i>
                        <?php endif; ?>
                    </small>
                </div>
                <small class="text-muted111">
                    <?= $favoriteEntityItem->getDescription() ?>
                </small>
            </span>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>


 <?php if($missingMethodList): ?>
     <ul>
         <?php foreach ($missingMethodList as $methodName): ?>
             <li><?= $methodName . ' (' . $methodCollectionIndexed[$methodName]->getTitle() . ')' ?></li>
         <?php endforeach; ?>
     </ul>
     <div class="form-group">
         <?= $formRender->input('save', 'submit') ?>
     </div>
 <?php else: ?>
     <div class="alert alert-secondary" role="alert">
         Method list is empty
     </div>
 <?php endif; ?>

<?= $formRender->endFrom() ?>
