<?php

namespace Untek\Sandbox\Sandbox\RpcMock\Domain\Forms;

use Untek\Domain\Validator\Interfaces\ValidationByMetadataInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Lib\Components\Status\Enums\StatusEnum;
use Untek\Domain\Components\Constraints\Enum;

class MethodForm implements ValidationByMetadataInterface
{

    protected $methodName = null;

    protected $version = null;

    protected $statusId = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('methodName', new Assert\NotBlank());
        $metadata->addPropertyConstraint('version', new Assert\NotBlank());
        $metadata->addPropertyConstraint('statusId', new Assert\NotBlank());
        $metadata->addPropertyConstraint('statusId', new Assert\Positive());
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusEnum::class,
        ]));
    }

    public function setMethodName($value) : void
    {
        $this->methodName = $value;
    }

    public function getMethodName()
    {
        return $this->methodName;
    }

    public function setVersion($value) : void
    {
        $this->version = $value;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function setStatusId($value) : void
    {
        $this->statusId = $value;
    }

    public function getStatusId()
    {
        return $this->statusId;
    }


}

