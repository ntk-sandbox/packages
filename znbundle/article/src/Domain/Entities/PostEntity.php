<?php

namespace Untek\Bundle\Article\Domain\Entities;

use DateTime;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Domain\Validator\Interfaces\ValidationByMetadataInterface;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;

class PostEntity implements ValidationByMetadataInterface, EntityIdInterface
{

    private $id;
    private $categoryId;
    private $title;
    private $createdAt;

    private $category;
    private $tags;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('title', new Assert\NotBlank);
        $metadata->addPropertyConstraint('title', Constraints\Length(['min' => 3]));
        $metadata->addPropertyConstraint('created_at', new Assert\NotBlank);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setCategoryId($categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory(CategoryEntity $category): void
    {
        $this->category = $category;
    }

    public function __construct()
    {
        $this->createdAt = new DateTime;
    }

    public function setCreatedAt($value)
    {
        $this->createdAt = new DateTime($value);
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags(Enumerable $tags): void
    {
        $this->tags = $tags;
    }

}
