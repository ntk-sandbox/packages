<?php

namespace ZnSandbox\Sandbox\Synchronize\Domain\Entities;

class DiffCollectionEntity
{

    private $tableName;

    private $forInsertIndexes;
    private $forDeleteIndexes;
    private $forUpdateIndexes;
    private $commonIndexes;

    private $forInsert;
    private $forDelete;
    private $forUpdate;

    private $diff;
    private $config;

    public function getTableName()
    {
        return $this->tableName;
    }

    public function setTableName($tableName): void
    {
        $this->tableName = $tableName;
    }

    public function getForInsertIndexes()
    {
        return $this->forInsertIndexes;
    }

    public function setForInsertIndexes($forInsertIndexes): void
    {
        $this->forInsertIndexes = $forInsertIndexes;
    }

    public function getForDeleteIndexes()
    {
        return $this->forDeleteIndexes;
    }

    public function setForDeleteIndexes($forDeleteIndexes): void
    {
        $this->forDeleteIndexes = $forDeleteIndexes;
    }

    public function getForUpdateIndexes()
    {
        return $this->forUpdateIndexes;
    }

    public function setForUpdateIndexes($forUpdateIndexes): void
    {
        $this->forUpdateIndexes = $forUpdateIndexes;
    }

    public function getCommonIndexes()
    {
        return $this->commonIndexes;
    }

    public function setCommonIndexes($commonIndexes): void
    {
        $this->commonIndexes = $commonIndexes;
    }

    /**
     * @return array[]
     */
    public function getForInsert()
    {
        return $this->forInsert;
    }

    /**
     * @param mixed $forInsert
     */
    public function setForInsert($forInsert): void
    {
        $this->forInsert = $forInsert;
    }

    /**
     * @return array[]
     */
    public function getForDelete(): array
    {
        return $this->forDelete;
    }

    /**
     * @param mixed $forDelete
     */
    public function setForDelete($forDelete): void
    {
        $this->forDelete = $forDelete;
    }

    /**
     * @return mixed
     */
    public function getForUpdate()
    {
        return $this->forUpdate;
    }

    /**
     * @param mixed $forUpdate
     */
    public function setForUpdate($forUpdate): void
    {
        $this->forUpdate = $forUpdate;
    }

    /**
     * @return \ZnCore\Collection\Interfaces\Enumerable | DiffItemEntity[]
     */
    public function getDiff()
    {
        return $this->diff;
    }

    public function setDiff($diff): void
    {
        $this->diff = $diff;
    }

    public function isEmpty(): bool
    {
        return
            $this->getForDeleteIndexes() == null &&
            $this->getForInsertIndexes() == null &&
            $this->getDiff()->isEmpty();
    }

    /**
     * @return mixed
     */
    public function getConfig(): DiffConfigEntity
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig(DiffConfigEntity $config): void
    {
        $this->config = $config;
    }

}
