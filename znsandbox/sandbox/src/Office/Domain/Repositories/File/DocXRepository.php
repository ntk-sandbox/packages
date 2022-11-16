<?php

namespace ZnSandbox\Sandbox\Office\Domain\Repositories\File;

use ZnSandbox\Sandbox\Office\Domain\Entities\DocXEntity;
use ZnSandbox\Sandbox\Office\Domain\Interfaces\Repositories\DocXRepositoryInterface;

class DocXRepository implements DocXRepositoryInterface
{

    public function tableName() : string
    {
        return 'office_doc_x';
    }

    public function getEntityClass() : string
    {
        return DocXEntity::class;
    }


}

