<?php

namespace Untek\User\Notify\Domain\Filters;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Model\Components\Constraints\Enum;
use Untek\Model\Validator\Interfaces\ValidationByMetadataInterface;
use Untek\Lib\Components\Status\Enums\StatusSimpleEnum;

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
