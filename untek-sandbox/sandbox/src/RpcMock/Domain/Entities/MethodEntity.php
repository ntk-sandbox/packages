<?php

namespace Untek\Sandbox\Sandbox\RpcMock\Domain\Entities;

use Untek\Crypt\Pki\JsonDSig\Domain\Entities\SignatureEntity;
use Untek\Crypt\Pki\JsonDSig\Domain\Libs\C14n;
use Untek\Model\Entity\Interfaces\EntityIdInterface;
use DateTime;
use Untek\Model\Validator\Interfaces\ValidationByMetadataInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Lib\Components\Status\Enums\StatusEnum;
use Untek\Model\Components\Constraints\Enum;
use Untek\Model\Entity\Interfaces\UniqueInterface;
use Untek\Sandbox\Sandbox\RpcMock\Domain\Libs\HasherHelper;

class MethodEntity implements EntityIdInterface, ValidationByMetadataInterface, UniqueInterface
{

    protected $id = null;

    protected $methodName = null;

    protected $version = null;

    protected $isRequireAuth = null;

    protected $request = null;

    protected $requestHash = null;

    protected $body = null;

    protected $meta = null;

    protected $error = null;

    protected $statusId = StatusEnum::ENABLED;

    protected $createdAt = null;

    protected $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('id', new Assert\Positive());
        $metadata->addPropertyConstraint('methodName', new Assert\NotBlank());
        $metadata->addPropertyConstraint('version', new Assert\NotBlank());
//        $metadata->addPropertyConstraint('body', new Assert\NotBlank());
//        $metadata->addPropertyConstraint('meta', new Assert\NotBlank());
        $metadata->addPropertyConstraint('statusId', new Assert\NotBlank());
        $metadata->addPropertyConstraint('statusId', new Assert\Positive());
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusEnum::class,
        ]));
        $metadata->addPropertyConstraint('createdAt', new Assert\NotBlank());
//        $metadata->addPropertyConstraint('updatedAt', new Assert\NotBlank());
    }

    public function unique() : array
    {
        return [];
    }

    public function setId($value) : void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
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

    public function getIsRequireAuth()
    {
        return $this->isRequireAuth;
    }

    public function setIsRequireAuth($isRequireAuth): void
    {
        $this->isRequireAuth = $isRequireAuth;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function setRequest($request): void
    {
        $this->request = $request;
    }

    public function getRequestHash(): ?string
    {
        if($this->request == null) {
            return null;
        }
        return HasherHelper::generateDigest($this->request);
    }

    public function setRequestHash($requestHash): void
    {
        $this->requestHash = $requestHash;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body): void
    {
        $this->body = $body;
    }

    public function getMeta()
    {
        return $this->meta;
    }

    public function setMeta($meta): void
    {
        $this->meta = $meta;
    }

    public function getError()
    {
        return $this->error;
    }

    public function setError($error): void
    {
        $this->error = $error;
    }

    public function setStatusId($value) : void
    {
        $this->statusId = $value;
    }

    public function getStatusId()
    {
        return $this->statusId;
    }

    public function setCreatedAt($value) : void
    {
        $this->createdAt = $value;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setUpdatedAt($value) : void
    {
        $this->updatedAt = $value;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
