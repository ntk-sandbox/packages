<?php

namespace ZnBundle\Language\Domain\Interfaces\Services;

use ZnBundle\Language\Domain\Entities\LanguageEntity;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnDomain\Service\Interfaces\CrudServiceInterface;

interface LanguageServiceInterface extends CrudServiceInterface
{

    /**
     * @return Enumerable | LanguageEntity[]
     */
    public function allEnabled(): Enumerable;
}
