<?php

namespace ZnSandbox\Sandbox\RpcClient\Domain\Services;

use ZnSandbox\Sandbox\RpcClient\Domain\Interfaces\Repositories\FavoriteRepositoryInterface;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use ZnLib\Components\Status\Enums\StatusEnum;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnDomain\Service\Base\BaseCrudService;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Query\Entities\Query;
use ZnSandbox\Sandbox\RpcClient\Domain\Entities\FavoriteEntity;
use ZnSandbox\Sandbox\RpcClient\Domain\Interfaces\Services\FavoriteServiceInterface;

/**
 * @method FavoriteRepositoryInterface getRepository()
 */
class FavoriteService extends BaseCrudService implements FavoriteServiceInterface
{

    private $authService;

    public function __construct(
        EntityManagerInterface $em,
        AuthServiceInterface $authService
    )
    {
        $this->setEntityManager($em);
        $this->authService = $authService;
    }

    public function getEntityClass(): string
    {
        return FavoriteEntity::class;
    }

    public function addFavorite(FavoriteEntity $favoriteEntity)
    {
        $favoriteEntity->setStatusId(StatusEnum::ENABLED);
        $favoriteEntity->setAuthorId($this->authService->getIdentity()->getId());
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
        $favoriteEntity->setAuthorId($this->authService->getIdentity()->getId());
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
            'author_id' => $this->authService->getIdentity()->getId()
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
        $query->where('author_id', $this->authService->getIdentity()->getId());
        return parent::findAll($query);
    }
}
