<?php

namespace Untek\Component\Web\Asset\Base;

use Untek\Component\Web\Asset\Interfaces\AssetInterface;
use Untek\Component\Web\View\Libs\View;

abstract class BaseAsset implements AssetInterface
{

    public function jsFiles(View $view)
    {

    }

    public function cssFiles(View $view)
    {

    }

    public function jsCode(View $view)
    {

    }

    public function cssCode(View $view)
    {

    }

    public function register(View $view)
    {
        $this->jsFiles($view);
        $this->cssFiles($view);
        $this->jsCode($view);
        $this->cssCode($view);
    }
}
