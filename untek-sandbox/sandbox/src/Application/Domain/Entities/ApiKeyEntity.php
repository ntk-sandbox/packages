<?php

namespace Untek\Sandbox\Sandbox\Application\Domain\Entities;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Lib\Components\Status\Enums\StatusEnum;
use Untek\Domain\Components\Constraints\Enum;
use Untek\Domain\Validator\Interfaces\ValidationByMetadataInterface;
use Untek\Domain\Entity\Interfaces\UniqueInterface;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;
use Untek\Lib\Web\Form\Interfaces\BuildFormInterface;

class ApiKeyEntity implements ValidationByMetadataInterface, UniqueInterface, EntityIdInterface, BuildFormInterface
{

    private $id = null;

    private $title = null;

    private $applicationId = null;

    private $value = null;

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
//        $metadata->addPropertyConstraint('id', new Assert\NotBlank);
        $metadata->addPropertyConstraint('applicationId', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('value', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusEnum::class,
        ]));
        $metadata->addPropertyConstraint('createdAt', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('expiredAt', new Assert\NotBlank);
    }

    public function buildForm(FormBuilderInterface $formBuilder)
    {
        $formBuilder
            ->add('applicationId', TextType::class, [
                'label' => 'applicationId'
            ])
            /*->add('value', TextType::class, [
                'label' => 'value'
            ])*/
            ->add('expiredAt', TextType::class, [
                'label' => 'expiredAt'
            ])
        ;
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

    public function getTitle()
    {
        if($this->getApplication()) {
            return $this->getApplication()->getTitle();
        }
        return $this->getId();
    }

    public function setTitle($title): void
    {
        //$this->title = $title;
    }

    public function setApplicationId($value) : void
    {
        $this->applicationId = $value;
    }

    public function getApplicationId()
    {
        return $this->applicationId;
    }

    public function setValue($value) : void
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
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
