<?php

/**
 * @var $this \ZnLib\Web\View\Libs\View
 * @var $baseUri string
 * @var $favoriteEntity \ZnSandbox\Sandbox\RpcClient\Domain\Entities\FavoriteEntity | null
 * @var $favoriteEntityItem \ZnSandbox\Sandbox\RpcClient\Domain\Entities\FavoriteEntity
 */

use ZnSandbox\Sandbox\RpcClient\Domain\Entities\ApiKeyEntity;

$isActive = $favoriteEntity && ($favoriteEntity->getId() == $favoriteEntityItem->getId() || $favoriteEntity->getChecksum() == $favoriteEntityItem->getChecksum());

?>

<a href="<?= \ZnLib\Web\Html\Helpers\Url::to([$baseUri, 'id' => $favoriteEntityItem->getId()]) ?>"
   style="border: 1px solid rgba(0,0,0,.125) !important; padding: 0.3rem 0.7rem;"
   class="list-group-item list-group-item-action <?= $isActive ? 'active' : '' ?>">
    <div class="d-flex w-100 justify-content-between">
        <?php


        $lifeTimeLimitNew = \ZnLib\Components\Time\Enums\TimeEnum::SECOND_PER_DAY;
        $lifeTimeLimitPartNew = $lifeTimeLimitNew / 3;
        $lifeTimeNew = time() - $favoriteEntityItem->getCreatedAt()->getTimestamp();
        $isNew = $lifeTimeNew < $lifeTimeLimitNew;
        $colorMaskNew = 'rgba(0,123,255,{{alpha}})';
        $colorNew = 'rgba(0,123,255,1)';
        if($lifeTimeNew < $lifeTimeLimitPartNew * 1) {
            $colorNew = '#007bff';
        } elseif($lifeTimeNew < $lifeTimeLimitPartNew * 2) {
            $colorNew = 'rgba(0,123,255,0.66)';
        } elseif($lifeTimeNew < $lifeTimeLimitPartNew * 3) {
            $colorNew = 'rgba(0,123,255,0.45)';
        }

        $isUpd = false;
        if($favoriteEntityItem->getUpdatedAt()) {

            $lifeTimeUpd = time() - $favoriteEntityItem->getUpdatedAt()->getTimestamp();
            //dump($favoriteEntityItem->getUpdatedAt()->getTimestamp());
            $isUpd = $lifeTimeUpd < \ZnLib\Components\Time\Enums\TimeEnum::SECOND_PER_DAY;
            $colorUpd = '#ffc107';
            if($lifeTimeUpd < \ZnLib\Components\Time\Enums\TimeEnum::SECOND_PER_HOUR * 8 * 1) {
                $colorUpd = '#ffc107';
            } elseif($lifeTimeUpd < \ZnLib\Components\Time\Enums\TimeEnum::SECOND_PER_HOUR * 8 * 2) {
                $colorUpd = 'rgba(255,193,7,0.66)';
            } elseif($lifeTimeUpd < \ZnLib\Components\Time\Enums\TimeEnum::SECOND_PER_HOUR * 8 * 3) {
                $colorUpd = 'rgba(255,193,7,0.45)';
            }
        }

        ?>
        <small>
            <?= $favoriteEntityItem->getMethod() ?>
            <?php if ($isNew): ?>
                <span class="badge badge-primary align-middle" style="background-color: <?= $colorNew ?> /*rgba(255,193,7,0.58)*/;">New</span>
            <?php endif; ?>

            <?php if ($isUpd): ?>
                <span class="badge badge-warning align-middle" style="background-color:  <?= $colorUpd ?>;">Upd</span>
            <?php endif; ?>
        </small>

        <small class="text-muted111">

            <?php if ($favoriteEntityItem->getBody()): ?>
                <i class="fas fa-database align-middle" style="-color: Dodgerblue;" title="With body"></i>
            <?php endif; ?>
            <?php if ($favoriteEntityItem->getMeta()): ?>
                <i class="fas fa-cog align-middle" style="-color: Mediumslateblue;" title="With meta"></i>
            <?php endif; ?>

            <?php if ($favoriteEntityItem->getAuthBy()): ?>
                <i class="fas fa-user" title="Auth by <?= $favoriteEntityItem->getAuth()->getLogin() ?>"></i>
            <?php endif; ?>
        </small>
    </div>
    <?php if ($favoriteEntityItem->getDescription()): ?>
        <small class="text-muted111">
            <?= $favoriteEntityItem->getDescription() ?>
        </small>
    <?php endif; ?>
</a>
