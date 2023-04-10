<?php

namespace Untek\Bundle\Language\Symfony4\Widgets\Language\Assets;

use Untek\Component\Web\Asset\Base\BaseAsset;
use Untek\Component\Web\View\Libs\View;

class LanguageAsset extends BaseAsset
{

    public function cssFiles(View $view)
    {
        $view->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css', [
            'integrity' => 'sha512-Cv93isQdFwaKBV+Z4X8kaVBYWHST58Xb/jVOcV9aRsGSArZsgAnFIhMpDoMDcFNoUtday1hdjn0nGp3+KZyyFw==',
            'crossorigin' => 'anonymous',
        ]);
    }
}
