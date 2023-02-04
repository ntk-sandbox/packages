<?php

namespace Untek\Bundle\Language\Domain\Filters;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Domain\Components\Constraints\Enum;
use Untek\Domain\Validator\Interfaces\ValidationByMetadataInterface;
use Untek\Lib\Components\Status\Enums\StatusSimpleEnum;

class BundleFilter implements ValidationByMetadataInterface
{

    protected $statusId = StatusSimpleEnum::ENABLED;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusSimpleEnum::class,
        ]));
    }

    public function setStatusId(int $value): void
    {
        $this->statusId = $value;
    }

    public function getStatusId()
    {
        return $this->statusId;
    }
}
