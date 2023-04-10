<?php

namespace Untek\Component\Web\Asset\Assets;

use Untek\Component\Web\Asset\Base\BaseAsset;
use Untek\Component\Web\View\Libs\View;

class Fontawesome5Asset extends BaseAsset
{

    public function cssFiles(View $view)
    {
        $view->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', [
            'integrity' => 'sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==',
            'crossorigin' => 'anonymous',
        ]);
    }
}
