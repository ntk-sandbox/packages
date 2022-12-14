<?php

namespace ZnUser\Identity\Domain\Relations;

use ZnUser\Authentication\Domain\Interfaces\Repositories\CredentialRepositoryInterface;
use ZnDomain\Relation\Libs\Types\OneToManyRelation;
use ZnDomain\Relation\Libs\Types\OneToOneRelation;
use ZnUser\Rbac\Domain\Interfaces\Repositories\AssignmentRepositoryInterface;

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
