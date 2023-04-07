<?php

namespace Untek\Bundle\Article\Domain\Entities;

use Untek\Model\Entity\Interfaces\EntityIdInterface;

class CategoryEntity implements EntityIdInterface
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