<?php

namespace Untek\Bundle\Article\Domain\Services;

use Untek\Domain\Domain\Interfaces\GetEntityClassInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Bundle\Article\Domain\Interfaces\PostRepositoryInterface;
use Untek\Bundle\Article\Domain\Interfaces\PostServiceInterface;

/**
 * Class PostService
 * @package Untek\Bundle\Article\Domain\Services
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