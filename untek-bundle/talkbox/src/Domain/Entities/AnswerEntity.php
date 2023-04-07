<?php

namespace Untek\Bundle\TalkBox\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Model\Validator\Interfaces\ValidationByMetadataInterface;
use Untek\Model\Entity\Interfaces\EntityIdInterface;

class AnswerEntity implements ValidationByMetadataInterface, EntityIdInterface
{

    private $id = null;
    private $requestText = null;

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

    public function getRequestText()
    {
        return $this->requestText;
    }

    public function setRequestText($requestText): void
    {
        $this->requestText = $requestText;
    }

}
