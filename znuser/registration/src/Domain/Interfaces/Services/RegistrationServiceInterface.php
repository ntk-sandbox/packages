<?php

namespace Untek\User\Registration\Domain\Interfaces\Services;

use Untek\User\Registration\Domain\Forms\RegistrationForm;
use Untek\User\Registration\Domain\Forms\RequestActivationCodeForm;

interface RegistrationServiceInterface
{

    public function requestActivationCode(RequestActivationCodeForm $requestActivationCodeForm);

    //public function createAccount(RegistrationForm $registrationForm, string $activationCode);
}
