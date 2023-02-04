<?php

namespace Untek\User\Notify\Domain\Services;

use Untek\User\Notify\Domain\Interfaces\Repositories\TypeI18nRepositoryInterface;
use Untek\User\Notify\Domain\Interfaces\Services\TypeI18nServiceInterface;
use Untek\Domain\Service\Base\BaseCrudService;

class TypeI18nService extends BaseCrudService implements TypeI18nServiceInterface
{

    public function __construct(TypeI18nRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }


}

