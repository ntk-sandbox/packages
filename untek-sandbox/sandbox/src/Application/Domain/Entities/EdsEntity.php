<?php

namespace Untek\Sandbox\Sandbox\Application\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Lib\Components\Status\Enums\StatusEnum;
use Untek\Model\Components\Constraints\Enum;
use Untek\Model\Validator\Interfaces\ValidationByMetadataInterface;
use Untek\Model\Entity\Interfaces\UniqueInterface;
use Untek\Model\Entity\Interfaces\EntityIdInterface;

class EdsEntity implements ValidationByMetadataInterface, UniqueInterface, EntityIdInterface
{

    private $id = null;

    private $applicationId = null;

    private $fingerprint = null;

    private $subject = null;

    private $certificateRequest = null;

    private $certificate = null;

    private $statusId = StatusEnum::ENABLED;

    private $createdAt = null;

    private $expiredAt = null;

    private $application = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('applicationId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('fingerprint', new Assert\NotBlank);
        $metadata->addPropertyConstraint('subject', new Assert\NotBlank);
        $metadata->addPropertyConstraint('certificateRequest', new Assert\NotBlank);
        $metadata->addPropertyConstraint('certificate', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusEnum::class,
        ]));
        $metadata->addPropertyConstraint('createdAt', new Assert\NotBlank);
        $metadata->addPropertyConstraint('expiredAt', new Assert\NotBlank);
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

    public function getApplicationId()
    {
        return $this->applicationId;
    }

    public function setApplicationId($applicationId): void
    {
        $this->applicationId = $applicationId;
    }

    public function setFingerprint($value) : void
    {
        $this->fingerprint = $value;
    }

    public function getFingerprint()
    {
        return $this->fingerprint;
    }

    public function setSubject($value) : void
    {
        $this->subject = $value;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getCertificateRequest()
    {
        return $this->certificateRequest;
    }

    public function setCertificateRequest($certificateRequest): void
    {
        $this->certificateRequest = $certificateRequest;
    }

    public function setCertificate($value) : void
    {
        $this->certificate = $value;
    }

    public function getCertificate()
    {
        return $this->certificate;
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

    public function setExpiredAt($value) : void
    {
        $this->expiredAt = $value;
    }

    public function getExpiredAt()
    {
        return $this->expiredAt;
    }

    public function getApplication(): ?ApplicationEntity
    {
        return $this->application;
    }

    public function setApplication(ApplicationEntity $application): void
    {
        $this->application = $application;
    }
}

