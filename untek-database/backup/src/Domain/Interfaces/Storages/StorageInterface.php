<?php

namespace Untek\Database\Backup\Domain\Interfaces\Storages;

use Untek\Core\Collection\Interfaces\Enumerable;

interface StorageInterface
{

    public function getNextCollection(string $table): Enumerable;

    public function insertBatch(string $table, array $data): void;

    public function close(string $table): void;

    public function truncate(string $table): void;

    public function tableList(): Enumerable;
}
