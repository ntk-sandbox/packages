<?php

namespace ZnUser\Password\Domain\Services;

use ZnDomain\Validator\Helpers\UnprocessableHelper;
use ZnUser\Password\Domain\Enums\UserSecurityNotifyTypeEnum;
use ZnUser\Password\Domain\Forms\CreatePasswordForm;
use ZnUser\Password\Domain\Forms\RequestActivationCodeForm;
use ZnUser\Password\Domain\Interfaces\Services\PasswordServiceInterface;
use ZnUser\Password\Domain\Interfaces\Services\RestorePasswordServiceInterface;
use ZnBundle\Notify\Domain\Interfaces\Services\EmailServiceInterface;
use ZnBundle\Summary\Domain\Interfaces\Services\AttemptServiceInterface;
use ZnUser\Confirm\Domain\Entities\ConfirmEntity;
use ZnUser\Confirm\Domain\Enums\ConfirmActionEnum;
use ZnUser\Authentication\Domain\Enums\CredentialTypeEnum;
use ZnUser\Authentication\Domain\Interfaces\Repositories\CredentialRepositoryInterface;
use ZnUser\Confirm\Domain\Interfaces\Services\ConfirmServiceInterface;
use ZnLib\Components\Time\Enums\TimeEnum;
use ZnDomain\Entity\Exceptions\AlreadyExistsException;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnLib\I18Next\Facades\I18Next;
use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnDomain\Validator\Helpers\ValidationHelper;
use ZnUser\Notify\Domain\Interfaces\Services\NotifyServiceInterface;

class RestorePasswordService implements RestorePasswordServiceInterface
{

    protected $passwordService;
    protected $credentialRepository;
    protected $emailService;
    protected $confirmService;
    private $attemptService;
    private $notifyService;

    public function __construct(
        CredentialRepositoryInterface $credentialRepository,
        PasswordServiceInterface $passwordService,
        EmailServiceInterface $emailService,
        AttemptServiceInterface $attemptService,
        ConfirmServiceInterface $confirmService,
        NotifyServiceInterface $notifyService
    )
    {
        $this->credentialRepository = $credentialRepository;
        $this->passwordService = $passwordService;
        $this->emailService = $emailService;
        $this->confirmService = $confirmService;
        $this->attemptService = $attemptService;
        $this->notifyService = $notifyService;
    }

    public function requestActivationCode(RequestActivationCodeForm $requestActivationCodeForm)
    {
        ValidationHelper::validateEntity($requestActivationCodeForm);
        try {
            $credentialEntity = $this->credentialRepository->findOneByCredential($requestActivationCodeForm->getEmail(), CredentialTypeEnum::EMAIL);
        } catch (NotFoundException $e) {
            $exception = new UnprocessibleEntityException();
            $exception->add('email', I18Next::t('core', 'message.not_found'));
            throw $exception;
        }

        $confirmEntity = new ConfirmEntity;
        $confirmEntity->setLogin($requestActivationCodeForm->getEmail());
        $confirmEntity->setAction(ConfirmActionEnum::RESTORE_PASSWORD);
        $confirmEntity->setExpire(time() + TimeEnum::SECOND_PER_MINUTE * 5);
        try {
            $this->confirmService->add($confirmEntity);
        } catch (AlreadyExistsException $e) {
            $message = I18Next::t('summary', 'attempt.message.attempts_have_been_exhausted_time', ['seconds' => $e->getMessage()]);
            throw new AlreadyExistsException($message);
        }

        $this->notifyService->sendNotifyByTypeName(UserSecurityNotifyTypeEnum::RESTORE_PASSWORD_ACTIVATION_CODE, $credentialEntity->getIdentityId(), [
            'code' => $confirmEntity->getCode(),
        ]);
    }

    public function createPassword(CreatePasswordForm $createPasswordForm)
    {
        ValidationHelper::validateEntity($createPasswordForm);
        $identityId = $this->identityIdByCredential($createPasswordForm->getEmail());
        // верификация кода активации
        $isVerify = $this->confirmService->isVerify($createPasswordForm->getEmail(), ConfirmActionEnum::RESTORE_PASSWORD, $createPasswordForm->getActivationCode());
        if (!$isVerify) {
            $message = I18Next::t('user.registration', 'registration.invalid_activation_code');
            UnprocessableHelper::throwItem('activation_code', $message);
        }
        $this->passwordService->setPassword($createPasswordForm->getPassword(), $identityId);
        $this->confirmService->activate($createPasswordForm->getEmail(), ConfirmActionEnum::RESTORE_PASSWORD, $createPasswordForm->getActivationCode());
    }

    /**
     * @param string $credential
     * @return int
     * @throws UnprocessibleEntityException
     */
    private function identityIdByCredential(string $credential): int
    {
        try {
            $credentialEntity = $this->credentialRepository->findOneByCredential($credential, CredentialTypeEnum::EMAIL);
            return $credentialEntity->getIdentityId();
        } catch (NotFoundException $e) {
            $exception = new UnprocessibleEntityException();
            $exception->add('email', I18Next::t('core', 'message.not_found'));
            throw $exception;
        }
    }
}
