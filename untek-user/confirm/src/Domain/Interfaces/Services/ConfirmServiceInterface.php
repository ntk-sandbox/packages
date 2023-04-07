<?php

namespace Untek\User\Confirm\Domain\Interfaces\Services;

use Untek\User\Confirm\Domain\Entities\ConfirmEntity;
use Untek\Model\Entity\Exceptions\AlreadyExistsException;
use Untek\Model\Service\Interfaces\CrudServiceInterface;

interface ConfirmServiceInterface extends CrudServiceInterface
{

    /**
     * @param ConfirmEntity $confirmEntity
     * @throws AlreadyExistsException
     */
    public function add(ConfirmEntity $confirmEntity);
}

