<?php

namespace ZnSandbox\Sandbox\Asset\Symfony4\Web\Forms;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnSandbox\Sandbox\Asset\Domain\Interfaces\Services\ServiceServiceInterface;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use ZnLib\Web\Form\Interfaces\BuildFormInterface;

class FileForm implements ValidationByMetadataInterface, BuildFormInterface
{

    private $serviceId;
    private $entityId;
    private $file;

    private $_serviceService;

    public function __construct(ServiceServiceInterface $serviceService)
    {
        $this->_serviceService = $serviceService;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('serviceId', new Assert\NotBlank());
        $metadata->addPropertyConstraint('entityId', new Assert\NotBlank());
        $metadata->addPropertyConstraint('file', new Assert\NotBlank());
        $metadata->addPropertyConstraint('file', new Assert\File());
    }

    public function buildForm(FormBuilderInterface $formBuilder)
    {
        $formBuilder
            ->add('serviceId', ChoiceType::class, [
                'label' => 'serviceId',
                'choices' => array_flip($this->getServiceOptions()),
            ])
            ->add('entityId', TextType::class, [
                'label' => 'entityId'
            ])
            ->add('file', FileType::class, [
                'label' => 'file'
            ]);
    }

    public function getServiceId(): ?int
    {
        return $this->serviceId;
    }

    public function setServiceId(?int $serviceId): void
    {
        $this->serviceId = $serviceId;
    }

    public function getEntityId(): ?int
    {
        return $this->entityId;
    }

    public function setEntityId(?int $entityId): void
    {
        $this->entityId = $entityId;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file): void
    {
        $this->file = $file;
    }

    public function getServiceOptions(): array
    {
        $collection = $this->_serviceService->findAll();
        $options = [];
        foreach ($collection as $entity) {
            $options[$entity->getId()] = $entity->getTitle();
        }
        return $options;
    }
}
