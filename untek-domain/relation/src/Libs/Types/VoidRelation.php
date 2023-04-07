<?php

namespace Untek\Model\Relation\Libs\Types;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Model\Relation\Interfaces\RelationInterface;

class VoidRelation extends BaseRelation implements RelationInterface
{

    protected function loadRelation(Enumerable $collection): void
    {

    }
}
