<?php

namespace Untek\Sandbox\Sandbox\I18n\Domain\Interfaces\Repositories;

use Untek\Domain\Repository\Interfaces\CrudRepositoryInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\Sandbox\Sandbox\I18n\Domain\Entities\TranslateEntity;

interface TranslateRepositoryInterface extends CrudRepositoryInterface
{

    public function findOneByEntity(int $entityTypeId, int $entityId, int $languageId, Query $query = null): TranslateEntity;
}
