<?php

namespace ZnSymfony\Sandbox\Symfony4\Web\Base;

use ZnSymfony\Sandbox\Symfony4\Web\Helpers\ModuleHelper;
use ZnSymfony\Sandbox\Symfony4\Web\Helpers\UrlHelper;
use App\Dashboard\Controllers\DashboardController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

abstract class BaseModule extends \ZnLib\Web\Controller\Base\BaseModule
{

    abstract public function getNamespace(): string;

    public function configRoutes(RouteCollection $routes): void
    {
        $namespace = $this->getNamespace();
        $map = ModuleHelper::map($namespace);
        $moduleId = ModuleHelper::extractModuleId($namespace);
        $uri = UrlHelper::generateUri($moduleId);
        $routeName = $moduleId;
        $routes->add($routeName, new Route($uri, [
            '_controller' => DashboardController::class,
            '_action' => 'index',
        ]));
        foreach ($map as $controllerId => $actions) {
            $controllerName = $controllerId . 'Controller';
            $controllerClass = $namespace . '\\Controllers\\' . $controllerName;
            foreach ($actions as $actionName) {
                $uri = UrlHelper::generateUri($moduleId, $controllerId, $actionName);
                $routeName = $moduleId . '_' . $controllerName . '_' . $actionName;
                $routes->add($routeName, new Route($uri, [
                    '_controller' => $controllerClass,
                    '_action' => $actionName,
                ]));
                if ($actionName == 'index') {
                    $uri = UrlHelper::generateUri($moduleId, $controllerId);
                    $routeName = $moduleId . '_' . $controllerName;
                    $routes->add($routeName, new Route($uri, [
                        '_controller' => $controllerClass,
                        '_action' => $actionName,
                    ]));
                }
            }
        }
    }
}
