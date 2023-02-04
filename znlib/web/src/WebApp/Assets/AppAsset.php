<?php

namespace Untek\Lib\Web\WebApp\Assets;

use Untek\Lib\Web\Asset\Base\BaseAsset;
use Untek\Lib\Web\View\Libs\View;

class AppAsset extends BaseAsset
{

    public function register(View $view)
    {
        (new \Untek\Lib\Web\Asset\Assets\Jquery3Asset())->register($view);
        (new \Untek\Lib\Web\Asset\Assets\AjaxLoaderAsset())->register($view);
        (new \Untek\Lib\Web\TwBootstrap\Assets\Bootstrap4Asset())->register($view);
        (new \Untek\Lib\Web\Asset\Assets\PopperAsset())->register($view);
        (new \Untek\Lib\Web\Asset\Assets\Fontawesome5Asset())->register($view);
    }
}
