<?php

use ZnSymfony\Sandbox\Symfony4\Web\Helpers\ModuleHelper;
use ZnCore\Text\Helpers\Inflector;
use ZnBundle\Language\Symfony4\Widgets\Language\LanguageWidget;
use ZnLib\Web\View\Libs\View;
use ZnLib\Web\TwBootstrap\Widgets\UserNavbarMenu\UserNavbarMenuWidget;

$modules = ModuleHelper::getModules();
$currentModule = ModuleHelper::getCurrentModule();

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">Sandbox</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Переключатель навигации">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <?php foreach ($modules as $module): ?>
                <li class="nav-item <?= $currentModule == Inflector::camel2id($module) ? 'active' : '' ?>">
                    <a class="nav-link" href="/<?= Inflector::camel2id($module) ?>">
                        <?= Inflector::titleize($module) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Поиск" aria-label="Поиск">
            <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Поиск</button>
        </form>
        <ul class="navbar-nav d-flex flex-row">
            <?= UserNavbarMenuWidget::widget([
                'userMenuHtml' => '
                        <a class="dropdown-item" href="/person-settings">
                            <i class="fas fa-user-cog"></i>
                            Персональные данные
                        </a>
                        <a class="dropdown-item" href="/update-password">
                            <i class="fas fa-user-cog"></i>
                            Изменить пароль
                        </a>
                    ',
            ]) ?>
        </ul>
    </div>
</nav>
