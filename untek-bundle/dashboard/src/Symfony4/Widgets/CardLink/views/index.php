<?php

/**
 * @var View $this
 * @var string $title
 * @var array $list
 */

use Untek\Lib\Web\View\Libs\View;

?>

<div class="card bg-primary">
    <div class="card-header">
        <?= $title ?>
    </div>
    <ul class="list-group list-group-flush">
        <?php foreach ($list as $item): ?>
            <li class="list-group-item">
                <?= $item ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
