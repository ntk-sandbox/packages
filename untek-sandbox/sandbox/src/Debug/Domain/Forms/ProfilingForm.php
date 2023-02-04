<?php

namespace Untek\Sandbox\Sandbox\Debug\Domain\Forms;

use Untek\Domain\Validator\Interfaces\ValidationByMetadataInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class ProfilingForm implements ValidationByMetadataInterface
{

    protected $requestId = null;

    protected $name = null;

    protected $timestamp = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('requestId', new Assert\NotBlank());
        $metadata->addPropertyConstraint('requestId', new Assert\Positive());
        $metadata->addPropertyConstraint('name', new Assert\NotBlank());
        $metadata->addPropertyConstraint('timestamp', new Assert\NotBlank());
    }

    public function setRequestId($value) : void
    {
        $this->requestId = $value;
    }

    public function getRequestId()
    {
        return $this->requestId;
    }

    public function setName($value) : void
    {
        $this->name = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setTimestamp($value) : void
    {
        $this->timestamp = $value;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }


}

