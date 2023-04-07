<?php

namespace Untek\User\Password\Domain\Services;

use Untek\User\Password\Domain\Interfaces\Services\PasswordHistoryServiceInterface;
use Untek\User\Password\Domain\Enums\UserActionEnum;
use Untek\User\Password\Domain\Enums\UserActionEventEnum;
use Untek\User\Identity\Domain\Events\UserActionEvent;
use Untek\User\Password\Domain\Interfaces\Services\PasswordServiceInterface;
use Untek\User\Password\Domain\Subscribers\SendNotifyAfterUpdatePasswordSubscriber;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Untek\User\Authentication\Domain\Interfaces\Repositories\CredentialRepositoryInterface;
use Untek\Core\EventDispatcher\Traits\EventDispatcherTrait;
use Untek\Lib\I18Next\Facades\I18Next;
use Untek\Model\Service\Base\BaseService;
use Untek\Model\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;

class PasswordService extends BaseService implements PasswordServiceInterface
{

    use EventDispatcherTrait;

    protected $credentialRepository;
    protected $passwordHistoryService;
    protected $passwordHasher;

    public function __construct(
        EntityManagerInterface $em,
        CredentialRepositoryInterface $credentialRepository,
        PasswordHistoryServiceInterface $passwordHistoryService,
        PasswordHasherInterface $passwordHasher

    )
    {
        $this->setEntityManager($em);
        $this->credentialRepository = $credentialRepository;
        $this->passwordHistoryService = $passwordHistoryService;

        $this->passwordHasher = $passwordHasher;
    }

    public function subscribes(): array
    {
        return [
            SendNotifyAfterUpdatePasswordSubscriber::class,
        ];
    }

    public function setPassword(string $newPassword, int $identityId = null)
    {
        $this->checkNewPasswordExists($newPassword, $identityId);
        $this->setNewPassword($newPassword, $identityId);
        $this->passwordHistoryService->add($newPassword, $identityId);
        $event = new UserActionEvent($identityId, UserActionEnum::UPDATE_PASSWORD);
        $this->getEventDispatcher()->dispatch($event, UserActionEventEnum::AFTER_UPDATE_PASSWORD);
    }

    /**
     * Установить новый пароль во все типы credential
     * @param string $newPassword
     * @param int|null $identityId
     */
    private function setNewPassword(string $newPassword, int $identityId = null)
    {
        $all = $this->credentialRepository->allByIdentityId($identityId, ['login', 'email']);
        $passwordHash = $this->passwordHasher->hash($newPassword);
        foreach ($all as $credentialEntity) {
            $credentialEntity->setValidation($passwordHash);
            $this->getEntityManager()->persist($credentialEntity);
        }
    }

    /**
     * Проверить новый пароль на существование и истории
     * @param string $newPassword
     * @param int|null $identityId
     * @throws UnprocessibleEntityException
     */
    private function checkNewPasswordExists(string $newPassword, int $identityId = null)
    {
        $isHasPassword = $this->passwordHistoryService->isHas($newPassword, $identityId);
        if ($isHasPassword) {
            $exception = new UnprocessibleEntityException();
            $exception->add('newPassword', I18Next::t('user.password', 'change-password.message.password_exists_in_history'));
            throw $exception;
        }
    }
}
