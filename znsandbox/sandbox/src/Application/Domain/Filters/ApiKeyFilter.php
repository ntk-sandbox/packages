<?php

namespace ZnSandbox\Sandbox\Application\Domain\Filters;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;

class ApiKeyFilter implements ValidationByMetadataInterface
{

    protected $applicationId;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('applicationId', new Assert\NotBlank());
        $metadata->addPropertyConstraint('applicationId', new Assert\Positive());
    }

    public function getApplicationId()
    {
        return $this->applicationId;
    }

    public function setApplicationId($applicationId): void
    {
        $this->applicationId = $applicationId;
    }
}
