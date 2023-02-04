<?php

namespace Untek\Bundle\Language\Domain\Interfaces\Services;

use Untek\Bundle\Language\Domain\Entities\LanguageEntity;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Domain\Service\Interfaces\CrudServiceInterface;

interface LanguageServiceInterface extends CrudServiceInterface
{

    /**
     * @return Enumerable | LanguageEntity[]
     */
    public function allEnabled(): Enumerable;
}
