<?php

namespace Untek\User\Password\Domain\Interfaces\Services;

use Untek\User\Password\Domain\Forms\CreatePasswordForm;
use Untek\User\Password\Domain\Forms\RequestActivationCodeForm;
use Untek\Model\Entity\Exceptions\AlreadyExistsException;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Model\Validator\Exceptions\UnprocessibleEntityException;

interface RestorePasswordServiceInterface
{

    /**
     * @param RequestActivationCodeForm $requestActivationCodeForm
     * @throws AlreadyExistsException
     * @throws UnprocessibleEntityException
     */
    public function requestActivationCode(RequestActivationCodeForm $requestActivationCodeForm);

    /**
     * @param CreatePasswordForm $createPasswordForm
     * @throws UnprocessibleEntityException
     * @throws NotFoundException
     */
    public function createPassword(CreatePasswordForm $createPasswordForm);

}
