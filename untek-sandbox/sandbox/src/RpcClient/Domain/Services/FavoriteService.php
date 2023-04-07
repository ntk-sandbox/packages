<?php

namespace Untek\Sandbox\Sandbox\RpcClient\Domain\Services;

use Symfony\Component\Security\Core\Security;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Lib\Components\Status\Enums\StatusEnum;
use Untek\Sandbox\Sandbox\RpcClient\Domain\Entities\FavoriteEntity;
use Untek\Sandbox\Sandbox\RpcClient\Domain\Interfaces\Repositories\FavoriteRepositoryInterface;
use Untek\Sandbox\Sandbox\RpcClient\Domain\Interfaces\Services\FavoriteServiceInterface;
use Untek\User\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use Untek\User\Authentication\Domain\Traits\GetUserTrait;

/**
 * @method FavoriteRepositoryInterface getRepository()
 */
class FavoriteService extends BaseCrudService implements FavoriteServiceInterface
{

    use GetUserTrait;

//    private $authService;

    public function __construct(
        EntityManagerInterface $em,
//        AuthServiceInterface $authService,
        private Security $security
    )
    {
        $this->setEntityManager($em);
//        $this->authService = $authService;
    }

    public function getEntityClass(): string
    {
        return FavoriteEntity::class;
    }

    public function addFavorite(FavoriteEntity $favoriteEntity)
    {
        $favoriteEntity->setStatusId(StatusEnum::ENABLED);
        $favoriteEntity->setAuthorId($this->getUser()->getId());
        if ($favoriteEntity->getId()) {

            /*try {
                $favoriteEntityUnique = $this->getRepository()->findOneByUnique($favoriteEntity);
                //if($favoriteEntityUnique->getId() != $favoriteEntityUnique->getId()) {
                    $this->getRepository()->deleteById($favoriteEntityUnique->getId());
                //}
            } catch (NotFoundException $e) {}*/

            $this->persist($favoriteEntity);
//            $this->getRepository()->update($favoriteEntity);
        } else {
            try {
//                $favoriteEntityUnique = $this->getRepository()->findOneByUnique($favoriteEntity);
                $favoriteEntity = $this->getRepository()->findOneByUnique($favoriteEntity);
            } catch (NotFoundException $e) {
            }
//            $this->getRepository()->update($favoriteEntity);
            $this->persist($favoriteEntity);
        }
        //dd(EntityHelper::toArray($favoriteEntity));
    }

    public function addHistory(FavoriteEntity $favoriteEntity)
    {
        $favoriteEntity->setStatusId(StatusEnum::WAIT_APPROVING);
        $favoriteEntity->setAuthorId($this->getUser()->getId());
        if ($favoriteEntity->getId()) {

            /*try {
                $favoriteEntityUnique = $this->getRepository()->findOneByUnique($favoriteEntity);
                //if($favoriteEntityUnique->getId() != $favoriteEntityUnique->getId()) {
                    $this->getRepository()->deleteById($favoriteEntityUnique->getId());
                //}
            } catch (NotFoundException $e) {}*/

            $this->persist($favoriteEntity);
//            $this->getRepository()->update($favoriteEntity);
        } else {
            try {
//                $favoriteEntityUnique = $this->getRepository()->findOneByUnique($favoriteEntity);
                $favoriteEntity = $this->getRepository()->findOneByUnique($favoriteEntity);
            } catch (NotFoundException $e) {
            }
//            $this->getRepository()->update($favoriteEntity);
            $this->persist($favoriteEntity);
        }
        //dd(EntityHelper::toArray($favoriteEntity));
    }

    public function allFavorite(Query $query = null)
    {
        $query = $this->forgeQuery($query);
        $query->orderBy([
            'method' => SORT_ASC,
        ]);
        $query->with(['auth']);
        $query->where('status_id', StatusEnum::ENABLED);
        return parent::findAll($query);
    }

    public function clearHistory()
    {
        $this->getRepository()->deleteByCondition([
            'status_id' => StatusEnum::WAIT_APPROVING,
            'author_id' => $this->getUser()->getId()
        ]);
    }

    public function allHistory(Query $query = null)
    {
        $query = $this->forgeQuery($query);
        $query->orderBy([
            'method' => SORT_ASC,
            'created_at' => SORT_ASC,
        ]);
        $query->with(['auth']);
        $query->where('status_id', StatusEnum::WAIT_APPROVING);
        $query->where('author_id', $this->getUser()->getId());
        return parent::findAll($query);
    }
}
