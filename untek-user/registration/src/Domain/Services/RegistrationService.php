<?php

namespace Untek\User\Registration\Domain\Services;

use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Untek\Bundle\Notify\Domain\Entities\EmailEntity;
use Untek\Bundle\Notify\Domain\Entities\SmsEntity;
use Untek\Bundle\Notify\Domain\Interfaces\Services\EmailServiceInterface;
use Untek\Bundle\Notify\Domain\Interfaces\Services\SmsServiceInterface;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Core\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use Untek\Domain\Entity\Exceptions\AlreadyExistsException;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Service\Base\BaseService;
use Untek\Domain\Validator\Helpers\UnprocessableHelper;
use Untek\Domain\Validator\Helpers\ValidationHelper;
use Untek\Lib\Components\Time\Enums\TimeEnum;
use Untek\Lib\I18Next\Facades\I18Next;
use Untek\User\Authentication\Domain\Entities\CredentialEntity;
use Untek\User\Authentication\Domain\Interfaces\Services\CredentialServiceInterface;
use Untek\User\Confirm\Domain\Entities\ConfirmEntity;
use Untek\User\Confirm\Domain\Enums\ConfirmActionEnum;
use Untek\User\Confirm\Domain\Interfaces\Services\ConfirmServiceInterface;
use Untek\User\Rbac\Domain\Entities\AssignmentEntity;
use Untek\User\Rbac\Domain\Enums\Rbac\SystemRoleEnum;
use Untek\User\Registration\Domain\Forms\CreateAccountForm;
use Untek\User\Registration\Domain\Forms\RequestActivationCodeForm;
use Untek\User\Registration\Domain\Interfaces\Services\RegistrationServiceInterface;

class RegistrationService extends BaseService implements RegistrationServiceInterface
{

    private $confirmService;
    private $passwordHasher;
    private $emailService;
    private $smsService;
    private $credentialService;

    public function __construct(
        EntityManagerInterface $em,
        ConfirmServiceInterface $confirmService,
        PasswordHasherInterface $passwordHasher,
        EmailServiceInterface $emailService,
        SmsServiceInterface $smsService,
        CredentialServiceInterface $credentialService
    )
    {
        $this->setEntityManager($em);
        $this->confirmService = $confirmService;
        $this->passwordHasher = $passwordHasher;
        $this->emailService = $emailService;
        $this->smsService = $smsService;
        $this->credentialService = $credentialService;
    }

    public function requestActivationCode(RequestActivationCodeForm $requestActivationCodeForm)
    {
        ValidationHelper::validateEntity($requestActivationCodeForm);

        $this->checkCredentialExists($requestActivationCodeForm);

        /*if ($requestActivationCodeForm->getEmail()) {
            try {
                $credentialEntity = $this->credentialService->findOneByCredentialValue($requestActivationCodeForm->getEmail());
                $e = new UnprocessibleEntityException();
                $e->add('email', I18Next::t('user.registration', 'registration.message.credential_already_exists'));
                throw $e;
            } catch (NotFoundException $e) {
            }
        }
        if ($requestActivationCodeForm->getPhone()) {
            try {
                $credentialEntity = $this->credentialService->findOneByCredentialValue($requestActivationCodeForm->getPhone());
                $e = new UnprocessibleEntityException();
                $e->add('phone', I18Next::t('user.registration', 'registration.message.credential_already_exists'));
                throw $e;
            } catch (NotFoundException $e) {
            }
        }*/

        $confirmEntity = new ConfirmEntity;
        $confirmEntity->setLogin($requestActivationCodeForm->getEmail());
        $confirmEntity->setAction(ConfirmActionEnum::REGISTRATION);
        $confirmEntity->setExpire(time() + TimeEnum::SECOND_PER_MINUTE * 5);

        /*try {
            $this->confirmService->add($confirmEntity);
        } catch (AlreadyExistsException $e) {
            $message = I18Next::t('summary', 'attempt.message.attempts_have_been_exhausted_time', ['seconds' => $e->getMessage()]);
            throw new AlreadyExistsException($message);
        }*/

        try {
            $this->confirmService->add($confirmEntity);
            if ($requestActivationCodeForm->getEmail()) {
                $emailEntity = new EmailEntity();
                $emailEntity->setTo($requestActivationCodeForm->getEmail());
                $subject = I18Next::t('user.registration', 'registration.notify.activation_code.subject');
                $emailEntity->setSubject($subject);
                $content = I18Next::t('user.registration', 'registration.notify.activation_code.content', [
                    'code' => $confirmEntity->getCode(),
                ]);
                $emailEntity->setBody($content);
                $this->emailService->push($emailEntity);
            } elseif ($requestActivationCodeForm->getPhone()) {
                $smsEntity = new SmsEntity();
                $smsEntity->setPhone($requestActivationCodeForm->getPhone());
                $content = I18Next::t('user.registration', 'registration.notify.activation_code.shortContent', [
                    'code' => $confirmEntity->getCode(),
                ]);
                $smsEntity->setMessage($content);
                $this->smsService->push($smsEntity);
            }
            //$this->confirmService->sendConfirmBySms($confirmEntity, ['user.registration', 'registration.activate_account_sms']);
        } catch (AlreadyExistsException $e) {
            $message = I18Next::t('user.registration', 'registration.user_already_exists_but_not_activation_time_left', ['timeLeft' => $e->getMessage()]);
            throw new AlreadyExistsException($message);
        }

        /*$this->notifyService->sendNotifyByTypeName(UserRegistrationNotifyTypeEnum::REGISTRATION, $credentialEntity->getIdentityId(), [
            'code' => $confirmEntity->getCode(),
        ]);*/


        /*$confirmEntity = new ConfirmEntity();

        $this->confirmService->add($confirmEntity);
        dd($registrationForm);*/
    }

    protected function checkCredentialExists($registrationForm)
    {
        $hasByEmail = $registrationForm->getEmail() && $this->credentialService->hasByCredentialValue($registrationForm->getEmail());
        $hasByPhone = $registrationForm->getPhone() && $this->credentialService->hasByCredentialValue($registrationForm->getPhone());

        if ($hasByEmail) {
            $message = I18Next::t('user.registration', 'registration.user_already_exists_and_activated');
            UnprocessableHelper::throwItems(['email' => $message]);
        }

        if ($hasByPhone) {
            $message = I18Next::t('user.registration', 'registration.user_already_exists_and_activated');
            UnprocessableHelper::throwItems(['phone' => $message]);
        }
    }

    public function createAccount(CreateAccountForm $registrationForm): IdentityEntityInterface
    {
        $this->checkCredentialExists($registrationForm);

        ValidationHelper::validateEntity($registrationForm);
        try {
            $isVerify = $this->confirmService->isVerify($registrationForm->getEmail(), ConfirmActionEnum::REGISTRATION, $registrationForm->getCode());
            if (!$isVerify) {
                $message = I18Next::t('user.registration', 'registration.invalid_activation_code');
                UnprocessableHelper::throwItems(['activation_code' => $message]);
            }
        } catch (NotFoundException $e) {
            $message = I18Next::t('user.registration', 'registration.temp_user_not_found');
            UnprocessableHelper::throwItems(['phone' => $message]);
        }
        /** @var IdentityEntityInterface $identityEntity */
        $identityEntity = $this->getEntityManager()->createEntity(IdentityEntityInterface::class);
        $identityEntity->setUsername($registrationForm->getEmail());
        $this->getEntityManager()->persist($identityEntity);

        $assignmentEntity = new AssignmentEntity();
        $assignmentEntity->setIdentityId($identityEntity->getId());
        $assignmentEntity->setItemName(SystemRoleEnum::USER);
        $this->getEntityManager()->persist($assignmentEntity);

        $passwordHash = $this->passwordHasher->hash($registrationForm->getPassword());

        if ($registrationForm->getEmail()) {
            $credentialEntity = new CredentialEntity();
            $credentialEntity->setIdentityId($identityEntity->getId());
            $credentialEntity->setType('email');
            $credentialEntity->setCredential($registrationForm->getEmail());
            $credentialEntity->setValidation($passwordHash);
            $this->getEntityManager()->persist($credentialEntity);
        }
        if ($registrationForm->getPhone()) {
            $credentialEntity = new CredentialEntity();
            $credentialEntity->setIdentityId($identityEntity->getId());
            $credentialEntity->setType('phone');
            $credentialEntity->setCredential($registrationForm->getPhone());
            $credentialEntity->setValidation($passwordHash);
            $this->getEntityManager()->persist($credentialEntity);
        }

        return $identityEntity;
    }
}
