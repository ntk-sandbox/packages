<?php

namespace ZnBundle\Dashboard\Symfony4\Widgets\Adv;

use ZnLib\Web\Widget\Base\BaseWidget2;

class AdvSliderWidget extends BaseWidget2
{

    public function run(): string
    {
        return '
            <div class="card  bg-primary">
                <div class="card-body">
                    Слайдер с рекламой
                </div>
            </div>
        ';
    }
}
