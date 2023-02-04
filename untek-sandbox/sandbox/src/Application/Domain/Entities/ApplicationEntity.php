<?php

namespace Untek\Sandbox\Sandbox\Application\Domain\Entities;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Bundle\Eav\Domain\Enums\AttributeTypeEnum;
use Untek\Lib\Components\Status\Enums\StatusEnum;
use Untek\Core\Enum\Helpers\EnumHelper;
use Untek\Domain\Components\Constraints\Enum;
use Untek\Domain\Validator\Interfaces\ValidationByMetadataInterface;
use Untek\Domain\Entity\Interfaces\UniqueInterface;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;
use Untek\Lib\Web\Form\Interfaces\BuildFormInterface;

class ApplicationEntity implements ValidationByMetadataInterface, UniqueInterface, EntityIdInterface, BuildFormInterface
{

    private $id = null;

    private $title = null;

    private $statusId = StatusEnum::ENABLED;

    private $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
//        $metadata->addPropertyConstraint('id', new Assert\NotBlank);
        $metadata->addPropertyConstraint('title', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusEnum::class,
        ]));
        $metadata->addPropertyConstraint('createdAt', new Assert\NotBlank);
    }

    public function buildForm(FormBuilderInterface $formBuilder)
    {
        $formBuilder
            ->add('title', TextType::class, [
                'label' => 'title'
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

    public function setTitle($value) : void
    {
        $this->title = $value;
    }

    public function getTitle()
    {
        return $this->title;
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
}

