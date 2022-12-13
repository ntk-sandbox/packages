<?php

namespace ZnUser\Notify\Domain\Filters;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnDomain\Components\Constraints\Enum;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use ZnLib\Components\Status\Enums\StatusSimpleEnum;

class HistoryFilter implements ValidationByMetadataInterface
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
