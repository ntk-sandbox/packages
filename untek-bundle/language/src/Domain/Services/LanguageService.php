<?php

namespace Untek\Bundle\Language\Domain\Services;

use Untek\Bundle\Language\Domain\Interfaces\Repositories\LanguageRepositoryInterface;
use Untek\Bundle\Language\Domain\Interfaces\Services\LanguageServiceInterface;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Service\Base\BaseCrudService;

class LanguageService extends BaseCrudService implements LanguageServiceInterface
{

    private $switchRepository;
    private $storageRepository;

    public function __construct(
        EntityManagerInterface $em,
        LanguageRepositoryInterface $repository
    )
    {
        $this->setEntityManager($em);
        $this->setRepository($repository);
    }

    public function allEnabled(): Enumerable
    {
        $query = $this->forgeQuery();
        $query->where('is_enabled', true);
        return $this->findAll($query);
    }
}
