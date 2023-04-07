<?php

namespace Untek\Bundle\Language\Domain\Services;

use Untek\Bundle\Language\Domain\Interfaces\Services\TranslateServiceInterface;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Bundle\Language\Domain\Entities\TranslateEntity;

class TranslateService extends BaseCrudService implements TranslateServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return TranslateEntity::class;
    }


}

