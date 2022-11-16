<?php

namespace ZnBundle\Reference\Domain\Services;

use ZnBundle\Reference\Domain\Interfaces\Repositories\ItemTranslationRepositoryInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\ItemTranslationServiceInterface;
use ZnDomain\Service\Base\BaseCrudService;

class ItemTranslationService extends BaseCrudService implements ItemTranslationServiceInterface
{

    public function __construct(ItemTranslationRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }


}

