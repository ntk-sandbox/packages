<?php

namespace ZnSandbox\Sandbox\Application\Symfony4\Admin\Forms;

use ZnSandbox\Sandbox\Application\Domain\Interfaces\Services\ApplicationServiceInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnBundle\Eav\Domain\Enums\AttributeTypeEnum;
use ZnCore\Enum\Helpers\EnumHelper;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use ZnLib\Web\Form\Interfaces\BuildFormInterface;

class ApiKeyForm implements ValidationByMetadataInterface, BuildFormInterface
{

    private $applicationId;
    private $expiredAt;

    private $_applicationService;

    public function __construct(ApplicationServiceInterface $applicationService)
    {
        $this->_applicationService = $applicationService;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('applicationId', new Assert\NotBlank());
        $metadata->addPropertyConstraint('expiredAt', new Assert\NotBlank());
    }

    public function buildForm(FormBuilderInterface $formBuilder)
    {
        $formBuilder
            ->add('applicationId', ChoiceType::class, [
                'label' => 'applicationId',
                'choices' => array_flip($this->getApplicationOptions()),
            ])
            ->add('expiredAt', TextType::class, [
                'label' => 'expiredAt'
            ]);
    }

    public function getApplicationId()
    {
        return $this->applicationId;
    }

    public function setApplicationId($applicationId): void
    {
        $this->applicationId = $applicationId;
    }

    public function getExpiredAt()
    {
        return $this->expiredAt;
    }

    public function setExpiredAt($expiredAt): void
    {
        $this->expiredAt = $expiredAt;
    }

    public function getApplicationOptions(): array
    {
        $collection = $this->_applicationService->findAll();
        $options = [];
        foreach ($collection as $entity) {
            $options[$entity->getId()] = $entity->getTitle();
        }
        return $options;
    }
}
