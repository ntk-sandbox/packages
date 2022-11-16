<?php

namespace ZnBundle\Dashboard\Symfony4\Widgets\CardLink;

use ZnLib\Web\Widget\Base\BaseWidget2;

class CardLinkWidget extends BaseWidget2
{

    private $title;
    private $list;

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function setList($list): void
    {
        $this->list = $list;
    }

    public function run(): string
    {
        return $this->render('index', [
            'title' => $this->title,
            'list' => $this->list,
        ]);
    }
}
