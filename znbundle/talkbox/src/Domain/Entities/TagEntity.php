<?php

namespace ZnBundle\TalkBox\Domain\Entities;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnFramework\Telegram\Domain\Libs\SoundexRuEn;
use Symfony\Component\Validator\Constraints as Assert;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use ZnDomain\Entity\Interfaces\EntityIdInterface;

class TagEntity implements ValidationByMetadataInterface, EntityIdInterface
{

    private $id = null;
    private $parentId = null;
    private $word = null;
    private $soundex = null;
    private $metaphone = null;

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

    public function setParentId($value) : void
    {
        $this->parentId = $value;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function setWord($value) : void
    {
        $this->word = $value;
    }

    public function getWord()
    {
        return $this->word;
    }

    public function getSoundex()
    {
        $soundex = new SoundexRuEn;
        return $soundex->encodeSoundex($this->getWord());
        //return $this->soundex;
    }

    public function setSoundex($soundex): void
    {
        $this->soundex = $soundex;
    }

    public function getMetaphone()
    {
        $soundex = new SoundexRuEn;
        return $soundex->encodeMetaphone($this->getWord());
        //return $this->metaphone;
    }

    public function setMetaphone($metaphone): void
    {
        $this->metaphone = $metaphone;
    }

}
