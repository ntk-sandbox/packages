<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Untek\Bundle\Eav\Symfony4\Admin\Controllers\AttributeController;
use Untek\Bundle\Eav\Symfony4\Admin\Controllers\CategoryController;
use Untek\Bundle\Eav\Symfony4\Admin\Controllers\EntityAttributeController;
use Untek\Bundle\Eav\Symfony4\Admin\Controllers\EntityController;
use Untek\Component\Web\Controller\Helpers\RouteHelper;

return function (RoutingConfigurator $routes) {
    RouteHelper::generateCrud($routes, EntityController::class, '/eav/entity');
    RouteHelper::generateCrud($routes, CategoryController::class, '/eav/category');
    RouteHelper::generateCrud($routes, AttributeController::class, '/eav/attribute');
    RouteHelper::generateCrud($routes, EntityAttributeController::class, '/eav/entity-attribute');
};
