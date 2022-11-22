<?php

namespace ZnUser\Authentication\Domain\Services;

use ZnUser\Authentication\Domain\Forms\AuthImitationForm;
use ZnUser\Authentication\Domain\Interfaces\Services\ImitationAuthServiceInterface;
use Symfony\Component\Validator\Constraints\Email;
use ZnDomain\Validator\Helpers\UnprocessableHelper;
use ZnDomain\Validator\Helpers\ValidationHelper;
use ZnCore\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnLib\I18Next\Facades\I18Next;
use ZnUser\Authentication\Domain\Entities\TokenValueEntity;

class ImitationAuthAuthService extends AuthService implements ImitationAuthServiceInterface
{

    public function tokenByImitation(AuthImitationForm $loginForm): TokenValueEntity
    {
        $userEntity = $this->getIdentityByForm($loginForm);

        $this->logger->info('auth tokenByForm');
        //$authEvent = new AuthEvent($loginForm);
        $tokenEntity = $this->tokenService->getTokenByIdentity($userEntity);
        $tokenEntity->setIdentity($userEntity);
        $this->em->loadEntityRelations($userEntity, ['assignments']);
        return $tokenEntity;
    }

    private function getIdentityByForm(AuthImitationForm $loginForm): IdentityEntityInterface
    {
        ValidationHelper::validateEntity($loginForm);
//        $authEvent = new AuthEvent($loginForm);
//        $this->getEventDispatcher()->dispatch($authEvent, AuthEventEnum::BEFORE_AUTH);
        try {
            $errorCollection = ValidationHelper::validateValue($loginForm->getLogin(), [new Email()]);
            $isEmail = $errorCollection->count() <= 0;

            if ($isEmail) {
                $credentialEntity = $this->credentialRepository->findOneByCredential($loginForm->getLogin(), 'email');
            } else {
                $credentialEntity = $this->credentialRepository->findOneByCredential($loginForm->getLogin(), 'login');
            }
        } catch (NotFoundException $e) {
            $message = I18Next::t('authentication', 'auth.user_not_found');
            $this->logger->warning('auth authenticationByForm');
            UnprocessableHelper::throwItem('login', $message);
        }

        $userEntity = $this->findOneIdentityById($credentialEntity->getIdentityId());
//        $userEntity = $this->identityRepository->findOneById($credentialEntity->getIdentityId());
        return $userEntity;
    }
}
