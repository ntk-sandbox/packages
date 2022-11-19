<?php

namespace ZnBundle\Summary\Domain\Services;

use ZnBundle\Summary\Domain\Entities\AttemptEntity;
use ZnBundle\Summary\Domain\Exceptions\AttemptsBlockedException;
use ZnBundle\Summary\Domain\Exceptions\AttemptsExhaustedException;
use ZnBundle\Summary\Domain\Interfaces\Repositories\AttemptRepositoryInterface;
use ZnBundle\Summary\Domain\Interfaces\Services\AttemptServiceInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnLib\I18Next\Facades\I18Next;
use ZnLib\I18Next\Interfaces\Services\TranslationServiceInterface;
use ZnUser\Person\Domain\Interfaces\Repositories\PersonRepositoryInterface;

/**
 * @method AttemptRepositoryInterface getRepository()
 */
class AttemptService extends BaseCrudService implements AttemptServiceInterface
{

    public function __construct(EntityManagerInterface $em, private TranslationServiceInterface $translateService)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass(): string
    {
        return AttemptEntity::class;
    }

    public function check(int $identityId, string $action, int $lifeTime, int $attemptCount): void
    {
        $this->increment($identityId, $action);
        $count = $this->getRepository()->countByIdentityId($identityId, $action, $lifeTime);
        if ($count == $attemptCount) {
            $message = $this->translateService->t('summary', 'attempt.message.attempts_have_been_blocked');
            throw new AttemptsBlockedException($message);
        } elseif ($count > $attemptCount) {
            $message = $this->translateService->t('summary', 'attempt.message.attempts_have_been_exhausted');
            throw new AttemptsExhaustedException($message);
        }
    }

    private function increment(int $identityId, string $action, $data = null): void
    {
        $attemptEntity = new AttemptEntity();
        $attemptEntity->setIdentityId($identityId);
        $attemptEntity->setAction($action);
        $attemptEntity->setData($data);
        $this->getEntityManager()->persist($attemptEntity);
    }
}
