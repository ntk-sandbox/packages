<?php

namespace Untek\Bundle\Person\Domain\Services;

use Untek\Bundle\Person\Domain\Interfaces\Repositories\ContactTypeRepositoryInterface;
use Untek\Bundle\Person\Domain\Interfaces\Services\ContactTypeServiceInterface;
use Untek\Model\Service\Base\BaseCrudService;

class ContactTypeService extends BaseCrudService implements ContactTypeServiceInterface
{

    public function __construct(ContactTypeRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }
}
