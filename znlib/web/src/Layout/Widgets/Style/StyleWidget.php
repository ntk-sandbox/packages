<?php

namespace ZnLib\Web\Layout\Widgets\Style;

use ZnLib\Web\View\Resources\Css;
use ZnLib\Web\Widget\Base\BaseWidget2;

class StyleWidget extends BaseWidget2
{

    private $css;

    public function __construct(Css $css)
    {
        $this->css = $css;
    }

    public function run(): string
    {
        return $this->getView()->renderFile(
            __DIR__ . '/views/style.php', [
            'css' => $this->css,
        ]);
    }
}
