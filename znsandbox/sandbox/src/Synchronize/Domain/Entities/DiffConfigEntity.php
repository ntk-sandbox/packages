<?php

namespace ZnSandbox\Sandbox\Synchronize\Domain\Entities;

class DiffConfigEntity
{

    private $tableName = '';
    private $uniqueAttributes = [];
    private $updateAttributes = [];
    private $titleAttributes = [];
    private $clearCache = [];

    public function getTableName(): string
    {
        return $this->tableName;
    }

    public function setTableName(string $tableName): void
    {
        $this->tableName = $tableName;
    }

    public function getUniqueAttributes(): array
    {
        return $this->uniqueAttributes;
    }

    public function setUniqueAttributes(array $uniqueAttributes): void
    {
        $this->uniqueAttributes = $uniqueAttributes;
    }

    public function getUpdateAttributes(): array
    {
        return $this->updateAttributes;
    }

    public function setUpdateAttributes(array $updateAttributes): void
    {
        $this->updateAttributes = $updateAttributes;
    }

    public function getTitleAttributes(): array
    {
        return $this->titleAttributes;
    }

    public function setTitleAttributes(array $titleAttributes): void
    {
        $this->titleAttributes = $titleAttributes;
    }

    public function getClearCache(): array
    {
        return $this->clearCache;
    }

    public function setClearCache(array $clearCache): void
    {
        $this->clearCache = $clearCache;
    }
}
