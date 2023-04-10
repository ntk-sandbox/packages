<?php

namespace Untek\Component\Web\Widget\Widgets\Toastr;

use Untek\Component\Web\Asset\Base\BaseAsset;
use Untek\Component\Web\View\Libs\View;

class ToastrAsset extends BaseAsset
{

    public function jsFiles(View $view)
    {
        $view->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js');
        $view->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css');
    }
}
