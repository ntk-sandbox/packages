<?php

namespace Untek\Bundle\Article\Domain\Services;

use Untek\Model\Shared\Interfaces\GetEntityClassInterface;
use Untek\Model\Service\Base\BaseCrudService;
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