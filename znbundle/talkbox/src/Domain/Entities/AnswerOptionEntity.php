<?php

namespace ZnBundle\TalkBox\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use ZnDomain\Entity\Interfaces\EntityIdInterface;

class AnswerOptionEntity implements ValidationByMetadataInterface, EntityIdInterface
{

    private $id = null;

    private $answerId = null;

    private $sort = 100;

    private $text = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {

    }

    public function setId($value) : void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setAnswerId($value) : void
    {
        $this->answerId = $value;
    }

    public function getAnswerId()
    {
        return $this->answerId;
    }

    public function setSort($value) : void
    {
        $this->sort = $value;
    }

    public function getSort()
    {
        return $this->sort;
    }

    public function setText($value) : void
    {
        $this->text = $value;
    }

    public function getText()
    {
        return $this->text;
    }


}

