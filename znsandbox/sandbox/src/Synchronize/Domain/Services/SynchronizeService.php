<?php

namespace ZnSandbox\Sandbox\Synchronize\Domain\Services;

use Symfony\Contracts\Cache\CacheInterface;
use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnCore\Collection\Libs\Collection;
use ZnCore\Collection\Helpers\CollectionHelper;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Service\Base\BaseService;
use ZnDatabase\Base\Domain\Entities\TableEntity;
use ZnDatabase\Base\Domain\Repositories\Eloquent\SchemaRepository;
use ZnDatabase\Fixture\Domain\Repositories\DbRepository;
use ZnDatabase\Fixture\Domain\Repositories\FileRepository;
use ZnDatabase\Fixture\Domain\Services\FixtureService;
use ZnSandbox\Sandbox\Synchronize\Domain\Entities\DiffAttributeEntity;
use ZnSandbox\Sandbox\Synchronize\Domain\Entities\DiffCollectionEntity;
use ZnSandbox\Sandbox\Synchronize\Domain\Entities\DiffConfigEntity;
use ZnSandbox\Sandbox\Synchronize\Domain\Entities\DiffItemEntity;
use ZnSandbox\Sandbox\Synchronize\Domain\Interfaces\Services\SynchronizeServiceInterface;

class SynchronizeService extends BaseService implements SynchronizeServiceInterface
{

    private $cache;
    private $fixtureService;
    private $dbRepository;
    private $fileRepository;
    private $schemaRepository;
    private $config;

    public function __construct(
        EntityManagerInterface $em,
        CacheInterface $cache,
        FixtureService $fixtureService,
        DbRepository $dbRepository,
        FileRepository $fileRepository,
        SchemaRepository $schemaRepository
    )
    {
        $this->setEntityManager($em);
        $this->cache = $cache;
        $this->fixtureService = $fixtureService;
        $this->dbRepository = $dbRepository;
        $this->fileRepository = $fileRepository;
        $this->schemaRepository = $schemaRepository;
    }

    public function setConfig($config): void
    {
        $this->config = $config;
    }

    private function getFromDb(string $name, array $uniqueAttributes = null): array
    {
        $data = $this->dbRepository->loadData($name);
        $data = CollectionHelper::toArray($data);
        if ($uniqueAttributes) {
            $data = $this->indexingArray($data, $uniqueAttributes);
        }
        return $data;
    }

    private function getFromFixture(string $name, array $uniqueAttributes = null): array
    {
        $data = $this->fileRepository->loadData($name)->load();
        if ($uniqueAttributes) {
            $data = $this->indexingArray($data, $uniqueAttributes);
        }
        return $data;
    }

    public function indexingItem(array $item, array $uniqueAttributes): string
    {
        $uniqueValues = ArrayHelper::extractByKeys($item, $uniqueAttributes);
        $index = implode($uniqueValues, '|');
        return $index;
    }

    public function indexingArray(array $data, array $uniqueAttributes): array
    {
        $array = [];
        foreach ($data as $item) {
            $index = $this->indexingItem($item, $uniqueAttributes);
            $array[$index] = $item;
        }
        return $array;
    }

    private function allByIndexes(array $indexes, $data)
    {
        $result = [];
        foreach ($data as $index => $row) {
            if (in_array($index, $indexes)) {
                $result[$index] = $row;
            }
        }
        return $result;
    }

    private function getDiff(array $fixtureData, array $dbData, array $uniqueAttributes, array $updateAttributes): DiffCollectionEntity
    {
        $needForDb = array_diff(array_keys($fixtureData), array_keys($dbData));
        $needForFixture = array_diff(array_keys($dbData), array_keys($fixtureData));
        $common = array_intersect(array_keys($dbData), array_keys($fixtureData));

        $diffCollectionEntity = new DiffCollectionEntity();
        $diffCollectionEntity->setForInsertIndexes($needForDb);
        $diffCollectionEntity->setForInsert($this->allByIndexes($needForDb, $fixtureData));
        $diffCollectionEntity->setForDeleteIndexes($needForFixture);
        $diffCollectionEntity->setForDelete($this->allByIndexes($needForFixture, $dbData));
        $diffCollectionEntity->setCommonIndexes($common);

        $diffCollection = new Collection();
        $diff = [];

        foreach ($common as $index) {
            $entityFromFixtureAttributes = EntityHelper::toArray($fixtureData[$index]);
            $entityFromDbAttributes = EntityHelper::toArray($dbData[$index]);

            if ($updateAttributes) {
                $entityFromFixtureAttributes = ArrayHelper::extractByKeys($entityFromFixtureAttributes, $updateAttributes);
                $entityFromDbAttributes = ArrayHelper::extractByKeys($entityFromDbAttributes, $updateAttributes);
            }

            if ($entityFromFixtureAttributes != $entityFromDbAttributes) {
                $diffItemEntity = new DiffItemEntity();
                $diffItemEntity->setIndex($this->indexingItem($entityFromFixtureAttributes, $uniqueAttributes));
                $diffAttributeCollection = new Collection();

                foreach ($entityFromFixtureAttributes as $attributeName => $value) {
                    if ($entityFromFixtureAttributes[$attributeName] != $entityFromDbAttributes[$attributeName]) {
                        $diffAttributeEntity = new DiffAttributeEntity();
                        $diffAttributeEntity->setName($attributeName);
                        $diffAttributeEntity->setFromValue($entityFromDbAttributes[$attributeName]);
                        $diffAttributeEntity->setToValue($entityFromFixtureAttributes[$attributeName]);
                        $diffAttributeCollection->add($diffAttributeEntity);
                    }
                }
                $diffItemEntity->setAttributes($diffAttributeCollection);
                $diff[] = $index;
                $diffCollection->add($diffItemEntity);
            }
        }
        $diffCollectionEntity->setForUpdateIndexes($diff);
        $diffCollectionEntity->setDiff($diffCollection);
        return $diffCollectionEntity;
    }

    /**
     * @return Enumerable | DiffConfigEntity[]
     */
    public function config(): Enumerable
    {
        $config = $this->config;

        $config = ArrayHelper::index($config, 'tableName');

        /** @var TableEntity[] $tableCollection */
        /*$tableCollection = $this->schemaRepository->allTablesByName(array_keys($config));
        $result = [];
        $this->ff($tableCollection, $result);
        dd($result);*/

        return CollectionHelper::create(DiffConfigEntity::class, $config);
    }

    private function ff($tableCollection, &$result = [])
    {
        foreach ($tableCollection as $tableEntity) {
            if (!$tableEntity->getRelations()->isEmpty()) {
                foreach ($tableEntity->getRelations() as $relationEntity) {
                    if (!in_array($relationEntity->getTableName(), $result)) {
                        $tableCollection1 = $this->schemaRepository->allTablesByName([$relationEntity->getTableName()]);
                        //dd($tableCollection1);
                        $this->ff($tableCollection1, $result);
                        // dd($tableCollection1);
                        $tableName = $relationEntity->getTableName();
                        if (!in_array($tableName, $result)) {
                            $result[] = $tableName;
                        }
                    }
                }
                //dd($tableEntity);
                $result[] = $tableEntity->getName();
            }
        }
    }

    public function diff(): Enumerable
    {
        $configCollection = $this->config();
        $resultCollection = new Collection();
        foreach ($configCollection as $diffConfigEntity) {
            $diffCollectionEntity = $this->diffByTableConfig($diffConfigEntity);
            $resultCollection->add($diffCollectionEntity);
        }
        return $resultCollection;
    }

    public function diffByTableConfig(DiffConfigEntity $diffConfigEntity): DiffCollectionEntity
    {
        $uniqueAttributes = $diffConfigEntity->getUniqueAttributes();
        $updateAttributes = $diffConfigEntity->getUpdateAttributes();
        $tableName = $diffConfigEntity->getTableName();
        $fixtureData = $this->getFromFixture($tableName, $uniqueAttributes);
        $dbData = $this->getFromDb($tableName, $uniqueAttributes);
        $diffCollectionEntity = $this->getDiff($fixtureData, $dbData, $uniqueAttributes, $updateAttributes ?: []);
        $diffCollectionEntity->setTableName($tableName);
        $diffCollectionEntity->setConfig($diffConfigEntity);
        return $diffCollectionEntity;
    }

    public function sync()
    {
        $configCollection = $this->config();
        foreach ($configCollection as $diffConfigEntity) {
            $uniqueAttributes = $diffConfigEntity->getUniqueAttributes();
            $tableName = $diffConfigEntity->getTableName();
            $fixtureData = $this->getFromFixture($tableName, $uniqueAttributes);
            $dbData = $this->getFromDb($tableName, $uniqueAttributes);
            $queryBuilder = $this->dbRepository->getQueryBuilderByTableName($diffConfigEntity->getTableName());
            $diffCollectionEntity = $this->diffByTableConfig($diffConfigEntity);
            if ($diffCollectionEntity->getForInsertIndexes()) {
                foreach ($diffCollectionEntity->getForInsertIndexes() as $index) {
                    $fixtureRow = $fixtureData[$index];
                    if ($diffConfigEntity->getUpdateAttributes() && !in_array('id', $diffConfigEntity->getUpdateAttributes())) {
                        unset($fixtureRow['id']);
                    }
                    (clone $queryBuilder)->insert($fixtureRow);
                }
            }
            if ($diffCollectionEntity->getDiff()) {
                foreach ($diffCollectionEntity->getDiff() as $diffItemEntity) {
                    $index = $diffItemEntity->getIndex();
                    $fixtureRow = $fixtureData[$index];
                    $dbRow = $dbData[$index];
                    foreach ($diffItemEntity->getAttributes() as $attributeEntity) {
                        $attributeName = $attributeEntity->getName();
                        $dbRow[$attributeName] = $fixtureRow[$attributeName];
                    }
                    (clone $queryBuilder)->where('id', '=', $dbRow['id'])->update($dbRow);
                }
            }
            if ($diffCollectionEntity->getForDeleteIndexes()) {
                foreach ($diffCollectionEntity->getForDeleteIndexes() as $index) {
                    $dbRow = $dbData[$index];
                    (clone $queryBuilder)->delete($dbRow['id']);
                }
            }
            if (!empty($diffConfigEntity->getClearCache())) {
                foreach ($diffConfigEntity->getClearCache() as $cacheName) {
                    $this->cache->delete($cacheName);
                }
            }
        }
    }
}
