<?php

namespace ZnSandbox\Sandbox\RpcClient\Domain\Entities;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnLib\Components\Status\Enums\StatusEnum;
use ZnLib\Components\ReadOnly\Helpers\ReadOnlyHelper;
use ZnCore\Text\Helpers\StringHelper;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnDomain\Components\Constraints\Enum;
use ZnDomain\Entity\Interfaces\UniqueInterface;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;

class FavoriteEntity implements ValidationByMetadataInterface, UniqueInterface, EntityIdInterface
{

    private $id = null;

    private $parentId = null;

    private $uid = null;

    private $checksum = null;

    private $version = "1";

    private $method = null;

    private $body = null;

    private $meta = null;

    private $authBy = null;

    private $description = null;

    private $authorId = null;

    private $statusId = StatusEnum::WAIT_APPROVING;

    private $createdAt = null;

    private $updatedAt = null;

    private $auth = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
//        $metadata->addPropertyConstraint('id', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('uid', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('checksum', new Assert\NotBlank);
        $metadata->addPropertyConstraint('version', new Assert\NotBlank);
        $metadata->addPropertyConstraint('method', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('body', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('meta', new Assert\NotBlank);
        $metadata->addPropertyConstraint('authorId', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('description', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusEnum::class,
        ]));
        $metadata->addPropertyConstraint('createdAt', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('updatedAt', new Assert\NotBlank);
    }

    public function unique(): array
    {
        return [
            ['checksum', 'version', 'status_id'],
        ];
    }

    public function setId($value): void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function setParentId($parentId): void
    {
        $this->parentId = $parentId;
    }

    public function setUid($value): void
    {
        ReadOnlyHelper::checkAttribute($this->uid, $value, $this, 'uid');
        $this->uid = $value;
    }

    public function getUid()
    {
        if (empty($this->uid)) {
            $this->uid = Uuid::v4()->toRfc4122();
        }
        return $this->uid;
    }

    public function getChecksum()
    {
        /*if($this->statusId < StatusEnum::ENABLED) {
            return null;
        }*/
        return $this->checksum;
    }

    public function setChecksum($checksum): void
    {
        $this->checksum = $checksum;
    }

    public function generateUid()
    {
        $scope =
            $this->getMethod() .
            ($this->getBody() ? json_encode($this->getBody()) : '{}') .
            ($this->getMeta() ? json_encode($this->getMeta()) : '{}') .
            $this->getAuthBy();
        $hashBin = hash('sha1', $scope, true);
        $hash = StringHelper::base64UrlEncode($hashBin);
        $hash = rtrim($hash, '=');
        $this->setChecksum($hash);
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    public function setMethod($value): void
    {
        $this->method = $value;
        $this->generateUid();
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setBody($value): void
    {
        $this->body = $value;
        $this->generateUid();
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setMeta($value): void
    {
        $this->meta = $value;
        $this->generateUid();
    }

    public function getMeta()
    {
        return $this->meta;
    }

    public function setAuthBy($value): void
    {
        $this->authBy = $value;
        $this->generateUid();
    }

    public function getAuthBy()
    {
        return $this->authBy;
    }

    public function setDescription($value): void
    {
        $this->description = $value;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function setAuthorId($authorId): void
    {
        $this->authorId = $authorId;
    }

    public function setStatusId($value): void
    {
        $this->statusId = $value;
    }

    public function getStatusId()
    {
        return $this->statusId;
    }

    public function setCreatedAt(\DateTime $value): void
    {
        $this->createdAt = $value;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setUpdatedAt(?\DateTime $value): void
    {
        $this->updatedAt = $value;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function getAuth(): ?UserEntity
    {
        return $this->auth;
    }

    public function setAuth(?UserEntity $auth): void
    {
        $this->auth = $auth;
    }
}
