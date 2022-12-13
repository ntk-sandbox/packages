<?php

namespace ZnUser\Notify\Domain\Services;

use ZnUser\Notify\Domain\Interfaces\Repositories\TypeI18nRepositoryInterface;
use ZnUser\Notify\Domain\Interfaces\Services\TypeI18nServiceInterface;
use ZnDomain\Service\Base\BaseCrudService;

class TypeI18nService extends BaseCrudService implements TypeI18nServiceInterface
{

    public function __construct(TypeI18nRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }


}

