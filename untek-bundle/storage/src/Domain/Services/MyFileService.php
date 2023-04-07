<?php

namespace Untek\Bundle\Storage\Domain\Services;

use Symfony\Component\Security\Core\Security;
use Untek\Bundle\Storage\Domain\Entities\FileEntity;
use Untek\Bundle\Storage\Domain\Interfaces\Repositories\MyFileRepositoryInterface;
use Untek\Bundle\Storage\Domain\Interfaces\Services\MyFileServiceInterface;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Query\Entities\Join;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\User\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use Untek\User\Authentication\Domain\Traits\GetUserTrait;

class MyFileService extends BaseCrudService implements MyFileServiceInterface
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
        return FileEntity::class;
    }

    protected function forgeQuery(Query $query = null): Query
    {
        return parent::forgeQuery($query)
            ->joinNew(new Join('storage_file_usage', 'storage_file.id', 'storage_file_usage.file_id'))
            ->where('storage_file_usage.user_id', $this->getUser()->getId());
    }
}
