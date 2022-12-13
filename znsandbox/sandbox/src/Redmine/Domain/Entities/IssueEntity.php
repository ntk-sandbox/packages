<?php

namespace ZnSandbox\Sandbox\Redmine\Domain\Entities;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use ZnDomain\Entity\Interfaces\UniqueInterface;
use ZnDomain\Entity\Interfaces\EntityIdInterface;

class IssueEntity implements ValidationByMetadataInterface, UniqueInterface, EntityIdInterface
{

    private $id = null;

    private $projectId = null;

    private $trackerId = null;

    private $statusId = null;

    private $priorityId = null;

    private $authorId = null;

    private $assignedId = null;

    private $subject = null;

    private $description = null;

    private $startDate = null;

    private $doneRatio = null;

    private $createdAt = null;

    private $updatedAt = null;

    private $project = null;

    private $tracker = null;

    private $status = null;

    private $priority = null;

    private $author = null;

    private $assigned = null;

    private $attachments = null;

    private $journals = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('id', new Assert\NotBlank);
        $metadata->addPropertyConstraint('projectId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('trackerId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('priorityId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('authorId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('assignedId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('subject', new Assert\NotBlank);
        $metadata->addPropertyConstraint('description', new Assert\NotBlank);
        $metadata->addPropertyConstraint('startDate', new Assert\NotBlank);
        $metadata->addPropertyConstraint('doneRatio', new Assert\NotBlank);
        $metadata->addPropertyConstraint('createdAt', new Assert\NotBlank);
        $metadata->addPropertyConstraint('updatedAt', new Assert\NotBlank);
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

    public function setProjectId($value) : void
    {
        $this->projectId = $value;
    }

    public function getProjectId()
    {
        return $this->projectId;
    }

    public function setTrackerId($value) : void
    {
        $this->trackerId = $value;
    }

    public function getTrackerId()
    {
        return $this->trackerId;
    }

    public function setStatusId($value) : void
    {
        $this->statusId = $value;
    }

    public function getStatusId()
    {
        return $this->statusId;
    }

    public function setPriorityId($value) : void
    {
        $this->priorityId = $value;
    }

    public function getPriorityId()
    {
        return $this->priorityId;
    }

    public function setAuthorId($value) : void
    {
        $this->authorId = $value;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function setAssignedId($value) : void
    {
        $this->assignedId = $value;
    }

    public function getAssignedId()
    {
        return $this->assignedId;
    }

    public function setSubject($value) : void
    {
        $this->subject = $value;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setDescription($value) : void
    {
        $this->description = $value;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setStartDate($value) : void
    {
        $this->startDate = $value;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setDoneRatio($value) : void
    {
        $this->doneRatio = $value;
    }

    public function getDoneRatio()
    {
        return $this->doneRatio;
    }

    public function setCreatedAt(DateTime $value) : void
    {
        $this->createdAt = $value;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setUpdatedAt(DateTime $value) : void
    {
        $this->updatedAt = $value;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function getProject(): ?ProjectEntity
    {
        return $this->project;
    }

    public function setProject(ProjectEntity $project): void
    {
        $this->project = $project;
    }

    public function getTracker(): ?TrackerEntity
    {
        return $this->tracker;
    }

    public function setTracker(TrackerEntity $tracker): void
    {
        $this->tracker = $tracker;
    }

    public function getStatus(): ?StatusEntity
    {
        return $this->status;
    }

    public function setStatus(StatusEntity $status): void
    {
        $this->status = $status;
    }

    public function getPriority(): ?PriorityEntity
    {
        return $this->priority;
    }

    public function setPriority(PriorityEntity $priority): void
    {
        $this->priority = $priority;
    }

    public function getAuthor(): ?UserEntity
    {
        return $this->author;
    }

    public function setAuthor(UserEntity $author): void
    {
        $this->author = $author;
    }

    public function getAssigned(): ?UserEntity
    {
        return $this->assigned;
    }

    public function setAssigned(UserEntity $assigned): void
    {
        $this->assigned = $assigned;
    }

    public function getAttachments()
    {
        return $this->attachments;
    }

    public function setAttachments($attachments): void
    {
        $this->attachments = $attachments;
    }

    public function getJournals()
    {
        return $this->journals;
    }

    public function setJournals($journals): void
    {
        $this->journals = $journals;
    }
}
