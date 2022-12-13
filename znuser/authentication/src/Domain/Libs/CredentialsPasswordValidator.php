<?php

namespace ZnUser\Authentication\Domain\Libs;

use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnCore\EventDispatcher\Traits\EventDispatcherTrait;
use ZnCrypt\Base\Domain\Exceptions\InvalidPasswordException;
use ZnCrypt\Base\Domain\Services\PasswordService;
use ZnUser\Authentication\Domain\Entities\CredentialEntity;

class CredentialsPasswordValidator
{

    use EventDispatcherTrait;

    public function __construct(
        private PasswordService $passwordService,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->setEventDispatcher($eventDispatcher);
    }

    public function isValidPassword(Enumerable $credentials, string $password): bool
    {
        foreach ($credentials as $credentialEntity) {
            $isValid = $this->isValidPasswordByCredential($credentialEntity, $password);
            if ($isValid) {
                return true;
            }
        }
        return false;
    }

    protected function isValidPasswordByCredential(CredentialEntity $credentialEntity, string $password): bool
    {
        try {
            $this->passwordService->validate($password, $credentialEntity->getValidation());
            return true;
        } catch (InvalidPasswordException $e) {
            return false;
        }
    }
}
