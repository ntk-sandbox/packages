<?php

namespace Untek\Component\Web\AdminApp\Assets;

use Untek\Component\Web\Asset\Base\BaseAsset;
use Untek\Component\Web\View\Libs\View;

class AdminAppAsset extends BaseAsset
{

    public function register(View $view)
    {
        (new \Untek\Component\Web\Asset\Assets\Jquery3Asset())->register($view);
        (new \Untek\Component\Web\TwBootstrap\Assets\Bootstrap4Asset())->register($view);
        (new \Untek\Component\Web\AdminLte3\Assets\AdminLte3Asset())->register($view);
        (new \Untek\Component\Web\Asset\Assets\PopperAsset())->register($view);
        (new \Untek\Component\Web\Asset\Assets\Fontawesome5Asset())->register($view);
    }
}
