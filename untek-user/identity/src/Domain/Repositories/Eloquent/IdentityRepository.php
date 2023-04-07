<?php

namespace Untek\User\Identity\Domain\Repositories\Eloquent;

use App\Organization\Domain\Interfaces\Repositories\LanguageRepositoryInterface;
use Untek\Core\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use Untek\User\Authentication\Domain\Interfaces\Repositories\CredentialRepositoryInterface;
use Untek\User\Identity\Domain\Interfaces\Repositories\IdentityRepositoryInterface;
use Untek\User\Identity\Domain\Relations\IdentityRelation;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Relation\Libs\Types\OneToManyRelation;
use Untek\Model\Relation\Libs\Types\OneToOneRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Database\Eloquent\Domain\Capsule\Manager;
use Untek\Model\Repository\Mappers\TimeMapper;
use Untek\User\Rbac\Domain\Interfaces\Repositories\AssignmentRepositoryInterface;
use Untek\User\Rbac\Domain\Interfaces\Repositories\RoleRepositoryInterface;

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
