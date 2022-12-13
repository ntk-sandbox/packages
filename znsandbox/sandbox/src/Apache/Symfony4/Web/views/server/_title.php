<?php
/**
 * @var \ZnSandbox\Sandbox\Apache\Domain\Entities\ServerEntity $serverEntity
 */
?>

<?php if ($serverEntity->getHosts()): ?>
    <a href="<?= $serverEntity->getHosts()->getUrl() ?>" class="">
        <?= $serverEntity->getServerName() ?>
    </a>
<?php else: ?>
    <span class="text-dark">
        <?= $serverEntity->getServerName() ?>
    </span>
<?php endif; ?>


<?php /*if (!empty($link['description'])): */?><!--
    <span class="text-secondary">
        <small><?/*= $link['description'] */?></small>
    </span>
<?php /*endif; */?>
<?php /*if (!$link['directory_exists']): */?>
    <span class="badge badge-pill badge-warning">No directory</span>
<?php /*endif; */?>
<?php /*if ($serverEntity->getHosts() == null): */?>
    <span class="badge badge-pill badge-warning">No hosts</span>
<?php /*endif; */?>
<?php /*if (!$link['htaccess_exists']): */?>
    <span class="badge badge-pill badge-info">.htaccess</span>
--><?php /*endif; */?>
