<?php

/**
 * @var View $this
 * @var int $countMyHistory
 * @var DataProvider $dataProvider
 */

use ZnLib\Web\Html\Helpers\Url;
use ZnLib\I18Next\Facades\I18Next;
use ZnDomain\DataProvider\Libs\DataProvider;
use ZnLib\Web\View\Libs\View;

?>

<a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-bell"></i>
    <?php if ($dataProvider->getTotalCount()): ?>
        <span class="badge badge-warning navbar-badge"><?= $dataProvider->getTotalCount() ?></span>
    <?php endif; ?>
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="max-width: 500px !important;">
    <!--<span class="dropdown-header"><? /*= $countMyHistory */ ?> Notifications</span>
    <div class="dropdown-divider"></div>-->

    <?php if ($dataProvider->getTotalCount()): ?>
        <?php foreach ($dataProvider->getCollection() as $notifyEntity): ?>
            <a href="<?= Url::to(['/notify/history/view', 'id' => $notifyEntity->getId()]) ?>" class="dropdown-item">
                <i class="<?= $notifyEntity->getIcon() ?> text-<?= $notifyEntity->getColor() ?> mr-2"></i> <?= $notifyEntity->getSubject() ?>
                <!--            <span class="float-right text-muted text-sm">3 mins</span>-->
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <span class="dropdown-item text-muted">
            <?= I18Next::t('user.notify', 'history.message.empty_list') ?>
        </span>
    <?php endif; ?>

    <!--<a href="<?= Url::to(['/notify/history']) ?>" class="dropdown-item">
        <i class="fas fa-bell mr-2"></i> New notify
        <span class="badge badge-info"><?= $dataProvider->getTotalCount() ?></span>
        <span class="float-right text-muted text-sm">3 mins</span>
    </a>
    <a href="#" class="dropdown-item">
        <i class="fas fa-envelope mr-2"></i> 4 new messages
        <span class="float-right text-muted text-sm">3 mins</span>
    </a>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item">
        <i class="fas fa-users mr-2"></i> 8 friend requests
        <span class="float-right text-muted text-sm">12 hours</span>
    </a>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item">
        <i class="fas fa-file mr-2"></i> 3 new reports
        <span class="float-right text-muted text-sm">2 days</span>
    </a>-->

    <div class="dropdown-divider"></div>
    <a href="<?= Url::to(['/notify/history']) ?>" class="dropdown-item dropdown-footer">
        <?= I18Next::t('user.notify', 'history.action.see_all_notifications') ?>
    </a>
</div>
