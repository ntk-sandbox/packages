<?php

namespace ZnBundle\Article\Domain\Services;

use ZnDomain\Domain\Interfaces\GetEntityClassInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnBundle\Article\Domain\Interfaces\PostRepositoryInterface;
use ZnBundle\Article\Domain\Interfaces\PostServiceInterface;

/**
 * Class PostService
 * @package ZnBundle\Article\Domain\Services
 *
 * @property PostRepositoryInterface | GetEntityClassInterface $repository
 */
class PostService extends BaseCrudService implements PostServiceInterface
{

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

}