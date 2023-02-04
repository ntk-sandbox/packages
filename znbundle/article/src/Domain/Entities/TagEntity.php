<?php

namespace Untek\Bundle\Article\Domain\Entities;

use Untek\Domain\Entity\Interfaces\EntityIdInterface;

class TagEntity implements EntityIdInterface
{

    private $id;
    private $title;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }


}
