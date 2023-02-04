<?php

namespace Untek\Bundle\Messenger\Domain\Services;

use Symfony\Component\Security\Core\Security;
use Untek\Bundle\Messenger\Domain\Entities\ChatEntity;
use Untek\Bundle\Messenger\Domain\Interfaces\ChatRepositoryInterface;
use Untek\Bundle\Messenger\Domain\Interfaces\ChatServiceInterface;
use Untek\Bundle\Messenger\Domain\Interfaces\MemberRepositoryInterface;
use Untek\Bundle\User\Domain\Entities\User;
use Untek\Bundle\User\Domain\Services\AuthService;
use Untek\Bundle\User\Domain\Services\AuthService2;
use Untek\Core\Collection\Helpers\CollectionHelper;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Domain\Domain\Interfaces\GetEntityClassInterface;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\User\Authentication\Domain\Traits\GetUserTrait;

/**
 * @property ChatRepositoryInterface | GetEntityClassInterface $repository
 */
class ChatService extends BaseCrudService implements ChatServiceInterface
{

    //use UserAwareTrait;
    use GetUserTrait;

    private $memberRepository;

//    private $authService;

    public function __construct(
//        AuthServiceInterface $authService,
        ChatRepositoryInterface $repository,
        MemberRepositoryInterface $memberRepository,
        private Security $security
    ) {
        $this->setRepository($repository);
        // todo: заменить на Security
//        $this->authService = $authService;
        $this->memberRepository = $memberRepository;
    }

    private function allSelfChatIds(): array
    {
        /** @var User $userEntity */
        $userEntity = $this->getUser();
        $memberQuery = Query::forge();
        $memberQuery->where('user_id', $userEntity->getId());
        $memberCollection = $this->memberRepository->findAll($memberQuery);
        $chatIdArray = CollectionHelper::getColumn($memberCollection, 'chatId');
        return $chatIdArray;
    }

    public function findAll(Query $query = null): Enumerable
    {
        /** @var ChatEntity[] $collection */
        $collection = parent::findAll($query);
        foreach ($collection as $entity) {
            $entity->setAuthUserId($this->getUser()->getId());
        }
        return $collection;
    }

    protected function forgeQuery(Query $query = null): Query
    {
        $query = parent::forgeQuery($query);
        $chatIdArray = $this->allSelfChatIds();
        $query->where('id', $chatIdArray);
        return $query;
    }

    public function create($attributes): EntityIdInterface
    {
        // todo: create by self user id
        return parent::create($attributes);
    }

    public function updateById($id, $data)
    {
        // todo:
        return parent::updateById($id, $data);
    }

    public function deleteById($id)
    {
        // todo:
        return parent::deleteById($id);
    }

}