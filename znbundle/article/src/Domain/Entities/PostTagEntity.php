<?php

namespace Untek\Bundle\Article\Domain\Entities;

use Untek\Domain\Entity\Interfaces\EntityIdInterface;

class PostTagEntity implements EntityIdInterface
{

    private $id;
    private $postId;
    private $tagId;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function setPostId($postId): void
    {
        $this->postId = $postId;
    }

    public function getTagId()
    {
        return $this->tagId;
    }

    public function setTagId($tagId): void
    {
        $this->tagId = $tagId;
    }

}
