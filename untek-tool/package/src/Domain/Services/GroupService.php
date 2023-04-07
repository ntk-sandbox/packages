<?php

namespace Untek\Tool\Package\Domain\Services;

use Untek\Model\Service\Base\BaseCrudService;
use Untek\Tool\Package\Domain\Repositories\File\GroupRepository;

class GroupService extends BaseCrudService
{

    public function __construct(GroupRepository $repository)
    {
        $this->setRepository($repository);
    }

}
