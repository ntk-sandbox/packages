<?php

namespace Untek\Domain\QueryFilter\Interfaces;

interface IgnoreAttributesInterface
{

    public function ignoreAttributesFromCondition(): array;
}