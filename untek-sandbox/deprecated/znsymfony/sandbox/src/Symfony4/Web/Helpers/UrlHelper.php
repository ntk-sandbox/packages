<?php

namespace Untek\Symfony\Sandbox\Symfony4\Web\Helpers;

use Untek\Core\Text\Helpers\Inflector;
use Untek\Component\Web\Html\Helpers\Url;
use ;

class UrlHelper
{

    public static function getSector(string $sectorIndex): ?string
    {
        $currentUri = \Untek\Lib\Components\Http\Helpers\UrlHelper::requestUri();
        $currentUriArr = explode('/', trim($currentUri, '/'));
        $currentModule = $currentUriArr[$sectorIndex] ?? null;
        return $currentModule;
    }

    public static function generateUri(string $moduleId, string $controllerId = null, string $actionName = null): string
    {
        $uri = '/' . Inflector::camel2id($moduleId);
        if($controllerId) {
            $uri .= '/' . Inflector::camel2id($controllerId);
        }
        if ($actionName) {
            $uri .= '/' . Inflector::camel2id($actionName);
        }
        return $uri;
    }
}
