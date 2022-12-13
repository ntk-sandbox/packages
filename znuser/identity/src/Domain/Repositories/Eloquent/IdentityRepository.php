<?php

namespace ZnUser\Identity\Domain\Repositories\Eloquent;

use App\Organization\Domain\Interfaces\Repositories\LanguageRepositoryInterface;
use ZnCore\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use ZnUser\Authentication\Domain\Interfaces\Repositories\CredentialRepositoryInterface;
use ZnUser\Identity\Domain\Interfaces\Repositories\IdentityRepositoryInterface;
use ZnUser\Identity\Domain\Relations\IdentityRelation;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Relation\Libs\Types\OneToManyRelation;
use ZnDomain\Relation\Libs\Types\OneToOneRelation;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnDatabase\Eloquent\Domain\Capsule\Manager;
use ZnDomain\Repository\Mappers\TimeMapper;
use ZnUser\Rbac\Domain\Interfaces\Repositories\AssignmentRepositoryInterface;
use ZnUser\Rbac\Domain\Interfaces\Repositories\RoleRepositoryInterface;

class IdentityRepository extends BaseEloquentCrudRepository implements IdentityRepositoryInterface
{

    protected $tableName = 'user_identity';
    protected $entityClass;
    protected $identityRelation;

    public function __construct(
        EntityManagerInterface $em,
        Manager $capsule,
        IdentityRelation $identityRelation
    )
    {
        parent::__construct($em, $capsule);
        $entity = $this->getEntityManager()->createEntity(IdentityEntityInterface::class);
        $this->entityClass = get_class($entity);
        $this->identityRelation = $identityRelation;
    }

    public function mappers(): array
    {
        return [
            new TimeMapper(['created_at', 'updated_at'])
        ];
    }

    public function getEntityClass(): string
    {
        return $this->entityClass;
    }

    public function relations()
    {
        return $this->identityRelation->relations();
        /*return [
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'id',
                'relationEntityAttribute' => 'credential',
                'foreignRepositoryClass' => CredentialRepositoryInterface::class,
                'foreignAttribute' => 'identity_id'
            ],
            [
                'class' => OneToManyRelation::class,
                'relationAttribute' => 'id',
                'relationEntityAttribute' => 'assignments',
                'foreignRepositoryClass' => AssignmentRepositoryInterface::class,
                'foreignAttribute' => 'identity_id'
            ],
        ];*/
    }

    public function findUserByUsername(string $username, Query $query = null): IdentityEntityInterface
    {
        return $this->findUserBy(['username' => $username], $query);
    }

    private function findUserBy(array $condition, Query $query = null): IdentityEntityInterface
    {
        $query = Query::forge($query);
        $query->whereFromCondition($condition);
        return $this->findOne($query);
    }
}
