<?php

namespace Untek\Lib\Web\RequireJs\Assets;

use Untek\Lib\Web\Asset\Base\BaseAsset;
use Untek\Lib\Web\View\Libs\View;

class RjsAppAsset extends BaseAsset
{

    public function register(View $view)
    {
        (new \Untek\Lib\Web\Asset\Assets\Jquery3Asset())->cssFiles($view);
        (new \Untek\Lib\Web\TwBootstrap\Assets\Bootstrap4Asset())->cssFiles($view);
        (new \Untek\Lib\Web\Asset\Assets\PopperAsset())->cssFiles($view);
        (new \Untek\Lib\Web\Asset\Assets\Fontawesome5Asset())->register($view);
    }
}
