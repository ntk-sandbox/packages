<?php

namespace ZnBundle\Notify\Domain\Interfaces\Repositories;

use ZnBundle\Notify\Domain\Entities\ToastrEntity;
use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnCore\Collection\Interfaces\Enumerable;

interface ToastrRepositoryInterface
{

    /**
     * @param ToastrEntity $toastrEntity
     * @return mixed
     * @throws UnprocessibleEntityException
     */
    public function create(ToastrEntity $toastrEntity);

    /**
     * @return \ZnCore\Collection\Interfaces\Enumerable | ToastrEntity[]
     */
    public function findAll(): Enumerable;
}
