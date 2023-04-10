<?php

/**
 * @var View $this
 * @var \Untek\Core\Collection\Interfaces\Enumerable | LanguageEntity[] $collection
 * @var string $language
 * @var string $baseUrl
 */

use Untek\Bundle\Language\Domain\Entities\LanguageEntity;
use Untek\Bundle\Language\Symfony4\Widgets\Language\Assets\LanguageAsset;
use Untek\Component\Web\Html\Helpers\Url;
use Untek\Component\Web\View\Libs\View;

(new LanguageAsset())->register($this);

?>

<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="flag-icon flag-icon-<?= $language ?>"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <?php foreach ($collection as $languageEntity): ?>
            <a href="<?= Url::to([$baseUrl, 'locale' => $languageEntity->getLocale()]) ?>"
               data-method="POST"
               class="dropdown-item <?= $languageEntity->getCode() == $language ? 'active' : '' ?>">
                <i class="flag-icon flag-icon-<?= $languageEntity->getCode() ?> mr-2"></i> <?= $languageEntity->getTitle() ?>
            </a>
        <?php endforeach; ?>
    </div>
</li>
