<?php

namespace Untek\Component\Web\Layout\Widgets\Style;

use Untek\Component\Web\View\Resources\Css;
use Untek\Component\Web\Widget\Base\BaseWidget2;

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
