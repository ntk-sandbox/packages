<?php

namespace Untek\Bundle\Summary\Domain\Services;

use Untek\Bundle\Summary\Domain\Entities\AttemptEntity;
use Untek\Bundle\Summary\Domain\Exceptions\AttemptsBlockedException;
use Untek\Bundle\Summary\Domain\Exceptions\AttemptsExhaustedException;
use Untek\Bundle\Summary\Domain\Interfaces\Repositories\AttemptRepositoryInterface;
use Untek\Bundle\Summary\Domain\Interfaces\Services\AttemptServiceInterface;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Lib\I18Next\Interfaces\Services\TranslationServiceInterface;

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
