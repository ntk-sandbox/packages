<?php

namespace Untek\Model\Components\SoftDelete\Traits\Entity;

use Untek\Lib\Components\Status\Enums\StatusEnum;

/**
 * @todo: перенести в отдельный пакет
 */
trait SoftRestoreEntityTrait
{

    abstract public function setStatusId(int $statusId): void;

    public function restore(): void
    {
        if ($this->getStatusId() == StatusEnum::ENABLED) {
            throw new \DomainException('The entry has already been restored');
        }
        $this->statusId = StatusEnum::ENABLED;
    }
}
