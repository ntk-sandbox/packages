<?php

namespace ZnUser\Authentication\Domain\Services;

use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Authentication\Token\NullToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraints\Email;
use ZnBundle\User\Domain\Entities\User;
use ZnCore\Contract\Common\Exceptions\InvalidMethodParameterException;
use ZnCore\EventDispatcher\Traits\EventDispatcherTrait;
use ZnDomain\Validator\Entities\ValidationErrorEntity;
use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnDomain\Validator\Helpers\ValidationHelper;
use ZnCore\Contract\Common\Exceptions\NotSupportedException;
use ZnCore\Contract\User\Exceptions\UnauthorizedException;
use ZnCore\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use ZnCore\Collection\Libs\Collection;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Repository\Traits\RepositoryAwareTrait;
use ZnCrypt\Base\Domain\Exceptions\InvalidPasswordException;
use ZnCrypt\Base\Domain\Services\PasswordService;
use ZnLib\I18Next\Facades\I18Next;
use ZnUser\Authentication\Domain\Entities\CredentialEntity;
use ZnUser\Authentication\Domain\Entities\TokenValueEntity;
use ZnUser\Authentication\Domain\Enums\AuthEventEnum;
use ZnUser\Authentication\Domain\Events\AuthEvent;
use ZnUser\Authentication\Domain\Forms\AuthForm;
use ZnUser\Authentication\Domain\Helpers\TokenHelper;
use ZnUser\Authentication\Domain\Interfaces\Repositories\CredentialRepositoryInterface;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use ZnUser\Authentication\Domain\Interfaces\Services\TokenServiceInterface;
use ZnUser\Identity\Domain\Events\IdentityEvent;
use ZnUser\Identity\Domain\Interfaces\Repositories\IdentityRepositoryInterface;

class AuthService implements AuthServiceInterface
{

    use RepositoryAwareTrait;
    use EventDispatcherTrait;

    protected $tokenService;
    protected $passwordService;
    protected $credentialRepository;
    protected $identityRepository;
    protected $logger;
    protected $identityEntity;
    protected $security;
    protected $em;

    public function __construct(
        IdentityRepositoryInterface $identityRepository,
        CredentialRepositoryInterface $credentialRepository,
        PasswordService $passwordService,
        TokenServiceInterface $tokenService,
        EntityManagerInterface $em,
        Security $security,
        LoggerInterface $logger,
        private TokenStorageInterface $tokenStorage
    )
    {
        $this->identityRepository = $identityRepository;
        $this->passwordService = $passwordService;
        $this->credentialRepository = $credentialRepository;
        $this->logger = $logger;
        $this->tokenService = $tokenService;
        $this->security = $security;
        $this->em = $em;
        $this->resetAuth();
    }

    protected function resetAuth()
    {
        $token = new NullToken();
        $this->security->setToken($token);
        $this->tokenStorage->setToken($token);
    }

    public function setIdentity(IdentityEntityInterface $identityEntity)
    {
        if (!$identityEntity->getRoles()) {
            $this->em->loadEntityRelations($identityEntity, ['assignments']);
        }
//        $token = new AnonymousToken([], $identityEntity);
        $token = new UsernamePasswordToken($identityEntity, 'main', $identityEntity->getRoles());
        $this->security->setToken($token);
        $this->tokenStorage->setToken($token);

        //$event = new IdentityEvent($identityEntity);
        //$this->getEventDispatcher()->dispatch($event, AuthEventEnum::BEFORE_SET_IDENTITY);
        $this->identityEntity = $identityEntity;
        //$this->getEventDispatcher()->dispatch($event, AuthEventEnum::AFTER_SET_IDENTITY);
    }

    public function getIdentity(): ?IdentityEntityInterface
    {
        $identityEntity = null;
        if ($this->security->getUser() != null) {
            $identityEntity = $this->security->getUser();
        } /*elseif($this->identityEntity) {
            $identityEntity = $this->identityEntity;
        }*/
        $event = new IdentityEvent();
        $event->setIdentityEntity($identityEntity);
        $this->getEventDispatcher()->dispatch($event, AuthEventEnum::BEFORE_GET_IDENTITY);
        /*if($event->getIdentityEntity()) {
            return $event->getIdentityEntity();
        }*/
        if ($this->isGuest()) {
            throw new UnauthorizedException();
        }
        $this->getEventDispatcher()->dispatch($event, AuthEventEnum::AFTER_GET_IDENTITY);
        return $event->getIdentityEntity();
    }

    public function isGuest(): bool
    {
        if ($this->security->getUser() != null) {
            return false;
        }
        $event = new IdentityEvent($this->identityEntity);
        $this->getEventDispatcher()->dispatch($event, AuthEventEnum::BEFORE_IS_GUEST);
        if (is_bool($event->getIsGuest())) {
            return $event->getIsGuest();
        }
        $this->getEventDispatcher()->dispatch($event, AuthEventEnum::AFTER_IS_GUEST);
        return true;
    }

    public function logout()
    {
        $event = new IdentityEvent($this->identityEntity);
        $this->getEventDispatcher()->dispatch($event, AuthEventEnum::BEFORE_LOGOUT);

        $this->identityEntity = null;
        $this->resetAuth();
        $this->logger->info('auth logout');
        $this->getEventDispatcher()->dispatch($event, AuthEventEnum::AFTER_LOGOUT);
    }

    public function tokenByForm(AuthForm $loginForm): TokenValueEntity
    {
        $userEntity = $this->getIdentityByForm($loginForm);

        $this->logger->info('auth tokenByForm');
        //$authEvent = new AuthEvent($loginForm);
        $tokenEntity = $this->tokenService->getTokenByIdentity($userEntity);
        $tokenEntity->setIdentity($userEntity);
        $this->em->loadEntityRelations($userEntity, ['assignments']);
        return $tokenEntity;
    }

    public function authByForm(AuthForm $authForm)
    {
        $userEntity = $this->getIdentityByForm($authForm);
        $this->setIdentity($userEntity);
    }

    public function authenticationByToken(string $token, string $authenticatorClassName = null)
    {
        try {
            $tokenValueEntity = TokenHelper::parseToken($token);
        } catch (InvalidMethodParameterException $e) {
            throw new UnauthorizedException($e->getMessage());
        }

        // todo: сделать обработчики токенов разных типов
        if ($tokenValueEntity->getType() == 'bearer') {
            $userId = $this->tokenService->getIdentityIdByToken($token);
            $query = new Query();
            /** @var IdentityEntityInterface $userEntity */
            $userEntity = $this->identityRepository->findOneById($userId, $query);
            $this->logger->info('auth authenticationByToken');
            return $userEntity;
        } else {
            throw new NotSupportedException('Token type "' . $tokenValueEntity->getType() . '" not supported in ' . get_class($this));
        }
    }

    /*public function authenticationByForm(LoginForm $loginForm)
    {
        DeprecateHelper::softThrow();
        $authForm = new AuthForm([
            'login' => $loginForm->login,
            'password' => $loginForm->password,
            'rememberMe' => $loginForm->rememberMe,
        ]);
        $this->authByForm($authForm);
        $this->logger->info('auth authenticationByForm');
    }*/

    private function getIdentityByForm(AuthForm $loginForm): IdentityEntityInterface
    {
        ValidationHelper::validateEntity($loginForm);
        $authEvent = new AuthEvent($loginForm);
        $this->getEventDispatcher()->dispatch($authEvent, AuthEventEnum::BEFORE_AUTH);
        try {
            $errorCollection = ValidationHelper::validateValue($loginForm->getLogin(), [new Email()]);
            $isEmail = $errorCollection->count() <= 0;
            if ($isEmail) {
                $credentialEntity = $this->credentialRepository->findOneByCredential($loginForm->getLogin(), 'email');
            } else {
                $credentialEntity = $this->credentialRepository->findOneByCredential($loginForm->getLogin(), 'login');
            }
        } catch (NotFoundException $e) {
            $errorCollection = new Collection();
            $ValidationErrorEntity = new ValidationErrorEntity;
            $ValidationErrorEntity->setField('login');
            $ValidationErrorEntity->setMessage(I18Next::t('authentication', 'auth.user_not_found'));
            $errorCollection->add($ValidationErrorEntity);
            $exception = new UnprocessibleEntityException;
            $exception->setErrorCollection($errorCollection);
            $this->logger->warning('auth authenticationByForm');
            //$this->getEventDispatcher()->dispatch($authEvent, AuthEventEnum::AFTER_AUTH_ERROR);
            throw $exception;
        }
        try {
            $this->verificationPasswordByCredential($credentialEntity, $loginForm->getPassword());
        } catch (UnprocessibleEntityException $e) {
            $this->getEventDispatcher()->dispatch($authEvent, AuthEventEnum::AFTER_AUTH_ERROR);
            throw $e;
        }

        /** @var IdentityEntityInterface $userEntity */
        $userEntity = $this->identityRepository->findOneById($credentialEntity->getIdentityId());
        $authEvent->setIdentityEntity($userEntity);
        $this->getEventDispatcher()->dispatch($authEvent, AuthEventEnum::AFTER_AUTH_SUCCESS);
        return $userEntity;
    }

    protected function verificationPasswordByCredential(CredentialEntity $credentialEntity, string $password)
    {
        try {
            $this->passwordService->validate($password, $credentialEntity->getValidation());
            $this->logger->info('auth verificationPassword');
        } catch (InvalidPasswordException $e) {
            $errorCollection = new Collection();
            $ValidationErrorEntity = new ValidationErrorEntity('password', I18Next::t('authentication', 'auth.incorrect_password'));
            $errorCollection->add($ValidationErrorEntity);
            $exception = new UnprocessibleEntityException;
            $exception->setErrorCollection($errorCollection);
            $this->logger->warning('auth verificationPassword');
            throw $exception;
        }
    }
}
