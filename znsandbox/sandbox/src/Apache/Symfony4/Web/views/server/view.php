<?php

/**
 * @var \ZnSandbox\Sandbox\Apache\Domain\Entities\ServerEntity $entity
 */

?>

<div class="container">

    <h1><a href="http://<?= $entity->getServerName() ?>" target="_blank"><?= $entity->getServerName() ?></a></h1>

    <?php if ($entity->getHosts() == null): ?>
        <div class="alert alert-warning" role="alert">
            No hosts
        </div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Value</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($entity->getConfig() as $configName => $configValue): ?>
            <tr>
                <th><?= $configName ?></th>
                <td><?= $configValue ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th>IP from hosts</th>
            <td><?= $entity->getHosts() ? $entity->getHosts()->getIp() : '-' ?></td>
        </tr>
        </tbody>
    </table>

    <a class="btn btn-primary" href="/">< Back</a>

</div>