<?php

namespace ZnBundle\Dashboard\Symfony4\Widgets\Mock;

use ZnLib\Web\Widget\Base\BaseWidget2;

class MockWidget extends BaseWidget2
{

    private $html;

    public function getHtml()
    {
        return $this->html;
    }

    public function setHtml($html): void
    {
        $this->html = $html;
    }

    public function run(): string
    {
        return $this->html;
    }
}
