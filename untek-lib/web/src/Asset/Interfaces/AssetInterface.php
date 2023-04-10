<?php

namespace Untek\Component\Web\Asset\Interfaces;

use Untek\Component\Web\View\Libs\View;

interface AssetInterface
{

    public function register(View $view);
}
