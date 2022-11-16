<?php

namespace ZnSandbox\Sandbox\RpcMock\Domain\Filters;

use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnLib\Components\Status\Enums\StatusEnum;
use ZnDomain\Components\Constraints\Enum;

class MethodFilter implements ValidationByMetadataInterface
{

    protected $methodName = null;

    protected $version = null;

    protected $statusId = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
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

