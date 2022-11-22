<?php

namespace ZnUser\Password\Domain\Services;

use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnDomain\Validator\Helpers\ValidationHelper;
use ZnLib\I18Next\Facades\I18Next;
use ZnUser\Authentication\Domain\Interfaces\Repositories\CredentialRepositoryInterface;
use ZnUser\Authentication\Domain\Traits\GetUserTrait;
use ZnUser\Password\Domain\Forms\UpdatePasswordForm;
use ZnUser\Password\Domain\Interfaces\Services\PasswordServiceInterface;
use ZnUser\Password\Domain\Interfaces\Services\UpdatePasswordServiceInterface;

class UpdatePasswordService implements UpdatePasswordServiceInterface
{

    use GetUserTrait;

    protected $passwordService;
    protected $credentialRepository;
    protected $passwordHasher;

    public function __construct(
        CredentialRepositoryInterface $credentialRepository,
        PasswordHasherInterface $passwordHasher,
        PasswordServiceInterface $passwordService,
        private Security $security
    ) {
        $this->credentialRepository = $credentialRepository;
        $this->passwordHasher = $passwordHasher;
        $this->passwordService = $passwordService;
    }

    public function update(UpdatePasswordForm $updatePasswordForm)
    {
        ValidationHelper::validateEntity($updatePasswordForm);
        $this->checkCurrentPassword($updatePasswordForm->getCurrentPassword());
        $identity = $this->getUser();
        $this->passwordService->setPassword($updatePasswordForm->getNewPassword(), $identity->getId());
    }

    /**
     * Проверить старый пароль
     * @param string $currentPassword
     * @throws UnprocessibleEntityException
     * @throws AuthenticationException
     */
    private function checkCurrentPassword(string $currentPassword)
    {
        $identity = $this->getUser();
        $all = $this->credentialRepository->allByIdentityId($identity->getId(), ['login', 'email']);
        $entity = $all->first();
        $isValidCurrentPassword = $this->passwordHasher->verify($entity->getValidation(), $currentPassword);
        if (!$isValidCurrentPassword) {
            $exception = new UnprocessibleEntityException();
            $exception->add(
                'currentPassword',
                I18Next::t('user.password', 'change-password.message.does_not_match_the_current_password')
            );
            throw $exception;
        }
    }
}
