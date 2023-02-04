<?php

namespace Untek\Bundle\Reference\Domain\Constraints;

use Symfony\Component\Validator\Constraint;

class ReferenceItem extends Constraint
{

    public $message = 'The item id "{{ value }}" does not belong to the book "{{ bookName }}"';
    public $notFoundMessage = 'Item with id "{{ value }}" not found';
    public $bookName;
}
