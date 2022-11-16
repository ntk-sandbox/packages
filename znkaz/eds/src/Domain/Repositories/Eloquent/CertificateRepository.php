<?php

namespace ZnKaz\Eds\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnKaz\Eds\Domain\Entities\CertificateEntity;
use ZnKaz\Eds\Domain\Interfaces\Repositories\CertificateRepositoryInterface;

class CertificateRepository extends BaseEloquentCrudRepository implements CertificateRepositoryInterface
{

    public function tableName() : string
    {
        return 'eds_certificate';
    }

    public function getEntityClass() : string
    {
        return CertificateEntity::class;
    }


}

