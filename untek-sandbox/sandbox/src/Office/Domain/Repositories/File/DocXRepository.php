<?php

namespace Untek\Sandbox\Sandbox\Office\Domain\Repositories\File;

use Untek\Sandbox\Sandbox\Office\Domain\Entities\DocXEntity;
use Untek\Sandbox\Sandbox\Office\Domain\Interfaces\Repositories\DocXRepositoryInterface;

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

