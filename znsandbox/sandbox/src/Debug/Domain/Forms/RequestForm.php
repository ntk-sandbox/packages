<?php

namespace ZnSandbox\Sandbox\Debug\Domain\Forms;

use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class RequestForm implements ValidationByMetadataInterface
{

    protected $uuid = null;

    protected $url = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('uuid', new Assert\NotBlank());
        $metadata->addPropertyConstraint('url', new Assert\NotBlank());
    }

    public function setUuid($value) : void
    {
        $this->uuid = $value;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function setUrl($value) : void
    {
        $this->url = $value;
    }

    public function getUrl()
    {
        return $this->url;
    }


}

