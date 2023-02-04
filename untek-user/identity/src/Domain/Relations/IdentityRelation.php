<?php

namespace Untek\User\Identity\Domain\Relations;

use Untek\User\Authentication\Domain\Interfaces\Repositories\CredentialRepositoryInterface;
use Untek\Domain\Relation\Libs\Types\OneToManyRelation;
use Untek\Domain\Relation\Libs\Types\OneToOneRelation;
use Untek\User\Rbac\Domain\Interfaces\Repositories\AssignmentRepositoryInterface;

class IdentityRelation
{

    public function relations()
    {
        return [
            [
                'class' => OneToManyRelation::class,
                'relationAttribute' => 'id',
                'relationEntityAttribute' => 'credentials',
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
        ];
    }
}
