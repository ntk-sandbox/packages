<?php

namespace Untek\Domain\Repository\Base;

use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\EntityManager\Traits\EntityManagerAwareTrait;
use Untek\Domain\Repository\Interfaces\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{

    use EntityManagerAwareTrait;

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }
}
