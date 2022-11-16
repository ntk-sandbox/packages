<?php

use ZnCore\Text\Helpers\Inflector;
use ZnLib\Components\Http\Helpers\UrlHelper;
use ZnLib\Web\TwBootstrap\Widgets\Breadcrumb\BreadcrumbWidget;

$currentUri = UrlHelper::requestUri();
$uri = trim($currentUri, '/');

if($uri) {
    $uriArr = explode('/', $uri);
    $bc = new BreadcrumbWidget;
    $bc->add('<i class="fa fa-home"></i>', '/');
    $uriString = '';
    foreach ($uriArr as $uriItem) {
        if($uriItem != 'index') {
            $uriString .= '/' . $uriItem;
            $label = Inflector::titleize($uriItem);
            $bc->add($label, $uriString);
        }
    }
    echo $bc->render();
}
