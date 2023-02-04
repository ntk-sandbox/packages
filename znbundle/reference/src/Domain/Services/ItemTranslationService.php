<?php

namespace Untek\Bundle\Reference\Domain\Services;

use Untek\Bundle\Reference\Domain\Interfaces\Repositories\ItemTranslationRepositoryInterface;
use Untek\Bundle\Reference\Domain\Interfaces\Services\ItemTranslationServiceInterface;
use Untek\Domain\Service\Base\BaseCrudService;

class ItemTranslationService extends BaseCrudService implements ItemTranslationServiceInterface
{

    public function __construct(ItemTranslationRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }


}

