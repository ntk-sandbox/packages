<?php

namespace Untek\Bundle\Reference\Domain\Interfaces\Services;

use Untek\Model\Service\Interfaces\CrudServiceInterface;

interface ItemBookServiceInterface extends CrudServiceInterface
{

    public function getBookId(): int;

    public function setBookId(int $bookId): void;

    public function getBookName(): string;

    public function setBookName(string $bookName): void;
}

