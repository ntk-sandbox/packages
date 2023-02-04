<?php

namespace Untek\Domain\Relation\Libs\Types;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Domain\Relation\Interfaces\RelationInterface;

class VoidRelation extends BaseRelation implements RelationInterface
{

    protected function loadRelation(Enumerable $collection): void
    {

    }
}
