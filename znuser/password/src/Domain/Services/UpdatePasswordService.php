<?php

namespace ZnUser\Password\Domain\Services;

use Symfony\Component\Security\Core\Security;
use ZnCore\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use ZnUser\Password\Domain\Forms\UpdatePasswordForm;
use ZnUser\Password\Domain\Interfaces\Services\PasswordServiceInterface;
use ZnUser\Password\Domain\Interfaces\Services\UpdatePasswordServiceInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use ZnCore\Contract\User\Exceptions\UnauthorizedException;
use ZnUser\Authentication\Domain\Interfaces\Repositories\CredentialRepositoryInterface;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use ZnLib\I18Next\Facades\I18Next;
use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnDomain\Validator\Helpers\ValidationHelper;

class UpdatePasswordService implements UpdatePasswordServiceInterface
{

    protected $authService;
    protected $passwordService;
    protected $credentialRepository;
    protected $passwordHasher;

    public function __construct(
        CredentialRepositoryInterface $credentialRepository,
        PasswordHasherInterface $passwordHasher,
        AuthServiceInterface $authService,
        PasswordServiceInterface $passwordService,
        private Security $security
    )
    {
        $this->credentialRepository = $credentialRepository;
        $this->passwordHasher = $passwordHasher;
        $this->authService = $authService;
        $this->passwordService = $passwordService;
    }

    private function getUser(): ?IdentityEntityInterface {
        $identityEntity = $this->security->getUser();
        if($identityEntity == null) {
            throw new UnauthorizedException();
        }
        return $identityEntity;
    }

    public function update(UpdatePasswordForm $updatePasswordForm)
    {
        ValidationHelper::validateEntity($updatePasswordForm);
        $this->checkCurrentPassword($updatePasswordForm->getCurrentPassword());
        $identity = $this->getUser();
//        $identity = $this->authService->getIdentity();
        $this->passwordService->setPassword($updatePasswordForm->getNewPassword(), $identity->getId());
    }

    /**
     * Проверить старый пароль
     * @param string $currentPassword
     * @throws UnprocessibleEntityException
     * @throws UnauthorizedException
     */
    private function checkCurrentPassword(string $currentPassword)
    {
        $identity = $this->getUser();
//        $identity = $this->authService->getIdentity();
        $all = $this->credentialRepository->allByIdentityId($identity->getId(), ['login', 'email']);
        $entity = $all->first();
        $isValidCurrentPassword = $this->passwordHasher->verify($entity->getValidation(), $currentPassword);
        if (!$isValidCurrentPassword) {
            $exception = new UnprocessibleEntityException();
            $exception->add('currentPassword', I18Next::t('user.password', 'change-password.message.does_not_match_the_current_password'));
            throw $exception;
        }
    }
}
