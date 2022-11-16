<?php

namespace ZnBundle\Person\Domain\Services;

use ZnBundle\Person\Domain\Interfaces\Repositories\ContactTypeRepositoryInterface;
use ZnBundle\Person\Domain\Interfaces\Services\ContactTypeServiceInterface;
use ZnDomain\Service\Base\BaseCrudService;

class ContactTypeService extends BaseCrudService implements ContactTypeServiceInterface
{

    public function __construct(ContactTypeRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }
}
