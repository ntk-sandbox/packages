<?php

namespace Untek\Bundle\TalkBox\Domain\Interfaces\Services;

use Untek\Bundle\TalkBox\Domain\Entities\TagEntity;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Service\Interfaces\CrudServiceInterface;

interface TagServiceInterface extends CrudServiceInterface
{

    public function allByWorlds(array $words, Query $query = null): Enumerable;

    public function findOneByWordOrCreate(string $word): TagEntity;
}
