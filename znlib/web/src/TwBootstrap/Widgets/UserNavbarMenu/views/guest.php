<?php

/**
 * @var View $this
 * @var string $loginUrl
 */

use Untek\Lib\I18Next\Facades\I18Next;
use Untek\Lib\Web\Html\Helpers\Url;
use Untek\Lib\Web\View\Libs\View;

?>

<li class="nav-item">
    <a class="nav-link" href="<?= Url::to($loginUrl) ?>">
        <i class="fas fa-sign-in-alt"></i>
        <?= I18Next::t('authentication', 'auth.title') ?>
    </a>
</li>
