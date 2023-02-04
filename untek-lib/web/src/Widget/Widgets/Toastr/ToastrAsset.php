<?php

namespace Untek\Lib\Web\Widget\Widgets\Toastr;

use Untek\Lib\Web\Asset\Base\BaseAsset;
use Untek\Lib\Web\View\Libs\View;

class ToastrAsset extends BaseAsset
{

    public function jsFiles(View $view)
    {
        $view->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js');
        $view->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css');
    }
}
