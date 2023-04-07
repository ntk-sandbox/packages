<?php

namespace Untek\Model\Components\SoftDelete\Traits\Entity;

use Untek\Lib\Components\Status\Enums\StatusEnum;

/**
 * @todo: перенести в отдельный пакет
 */
trait SoftDeleteEntityTrait
{

    abstract public function setStatusId(int $statusId): void;

    public function delete(): void
    {
        if ($this->getStatusId() == StatusEnum::DELETED) {
            throw new \DomainException('The entry has already been deleted');
        }
        $this->statusId = StatusEnum::DELETED;
    }
}
