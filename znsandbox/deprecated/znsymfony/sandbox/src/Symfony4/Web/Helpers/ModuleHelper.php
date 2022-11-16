<?php

namespace ZnSymfony\Sandbox\Symfony4\Web\Helpers;

use ReflectionClass;
use ReflectionMethod;
use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\Code\Helpers\ComposerHelper;
use ZnCore\FileSystem\Helpers\FindFileHelper;
use ZnCore\Text\Helpers\Inflector;
use ZnLib\Components\Http\Helpers\UrlHelper;
use ZnLib\Web\Controller\Base\BaseWebController;

class ModuleHelper
{

    public static function generateModuleConfig(): array
    {
        $config = [];
        $modules = ModuleHelper::getModules();
        foreach ($modules as $module) {
            $className = 'App\\' . $module . '\\Module';
            $config[] = new $className;
        }
        $config[] = new \App\Dashboard\Module();

        return $config;
    }

    public static function getCurrentModule(): string
    {
        $currentUri = UrlHelper::requestUri();
        return explode('/', $currentUri)[1];
    }

    public static function getModules(): array
    {
        $exclude = [
            'Dashboard'
        ];
        $result = [];
        $baseModuleDir = __DIR__ . '/../../../../../../../src';
        $modules = FindFileHelper::scanDir($baseModuleDir);
        ArrayHelper::removeByValue('Common', $modules);
        foreach ($modules as $moduleName) {
            $moduleFile = $baseModuleDir . '/' . $moduleName . '/Module.php';
            if (is_file($moduleFile) && !in_array($moduleName, $exclude)) {
                $result[] = $moduleName;
            }
        }
        return $result;
    }

    public static function extractModuleId(string $namespace): string
    {
        $moduleId = explode('\\', $namespace)[1];
        $moduleId = Inflector::camel2id($moduleId);
        return $moduleId;
    }

    public static function map(string $namespace): array
    {
        $controllers = self::getControllers($namespace);
        $map = [];
        foreach ($controllers as $controllerFile) {
            $controllerName = str_replace('.php', '', $controllerFile);
            $methods = self::getControllerActions($controllerName, $namespace);
            foreach ($methods as $methodName) {
                if ($methodName[0] != '_') {
                    $controllerId = str_replace('Controller', '', $controllerName);
                    $map[$controllerId][] = $methodName;
                }
            }
        }
        return $map;
    }

    private static function getControllerActions(string $controllerName, string $namespace): array
    {
        $controllerClass = $namespace . '\\Controllers\\' . $controllerName;
        $reflection = new ReflectionClass($controllerClass);
        /** @var ReflectionMethod[] $reflectionMethods */
        $reflectionMethods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
        $methods = [];
        foreach ($reflectionMethods as $reflectionMethod) {
            if ($reflectionMethod->isPublic() && $reflectionMethod->class != BaseWebController::class) {
                $methods[] = $reflectionMethod->name;
            }
        }
        return $methods;
    }

    private static function getControllers(string $namespace): array
    {
        $moduleDir = ComposerHelper::getPsr4Path($namespace);
        $controllerDir = $moduleDir . '/Controllers';
        return FindFileHelper::scanDir($controllerDir);
    }
}
