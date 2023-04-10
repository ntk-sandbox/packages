<?php

namespace Untek\Component\Web\RequireJs\Assets;

use Untek\Component\Web\Asset\Base\BaseAsset;
use Untek\Component\Web\View\Libs\View;

class RjsAppAsset extends BaseAsset
{

    public function register(View $view)
    {
        (new \Untek\Component\Web\Asset\Assets\Jquery3Asset())->cssFiles($view);
        (new \Untek\Component\Web\TwBootstrap\Assets\Bootstrap4Asset())->cssFiles($view);
        (new \Untek\Component\Web\Asset\Assets\PopperAsset())->cssFiles($view);
        (new \Untek\Component\Web\Asset\Assets\Fontawesome5Asset())->register($view);
    }
}
