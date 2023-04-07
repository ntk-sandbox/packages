<?php

namespace Untek\Model\Components\FileRepository\Repositories\Dynamic;

use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Core\FileSystem\Helpers\FileStorageHelper;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Components\ArrayRepository\Helpers\FilterHelper;
use Untek\Model\Components\FileRepository\Base\BaseFileCrudRepository;
use Untek\Lib\Components\DynamicEntity\Entities\DynamicEntity;
use Untek\Component\FormatAdapter\StoreFile;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;

class DynamicFileRepository extends BaseFileCrudRepository
{

    private $fileName;

    public function setFileName(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function fileName(): string
    {
        return $this->fileName;
    }

    public function getEntityClass(): string
    {
        return DynamicEntity::class;
    }

    public function allData()
    {
        return $this->getItems();
    }

    public function allAsArray(Query $query = null): array
    {
        FileStorageHelper::touchFile($this->fileName());
        $query = Query::forge($query);
        $items = $this->getBody();
        if ($query) {
            $items = FilterHelper::filterItems($items, $query);
        }
        return $items;
    }

    public function findOneByIdAsArray(int $id, Query $query = null): array
    {
        $query = Query::forge($query);
        $query->where('id', $id);
        $items = $this->allAsArray($query);
        if (empty($items)) {
            throw new NotFoundException();
        }
        return ArrayHelper::first($items);
    }

    public function dumpAll(array $items, array $attributes = null)
    {
        if ($attributes) {
            foreach ($items as &$item) {
                $item = ArrayHelper::extractByKeys($item, $attributes);
            }
        }
        $this->setItems($items);
    }

    public function dumpDataProvider(RpcResponseEntity $response, array $attributes = null)
    {
        $items = $response->getResult();
        $this->setItems([]);
        $this->setBody($items, $attributes);
        $this->setTotal($response->getMetaItem('totalCount'));

    }

    public function getBody()
    {
        $data = $this->getItems();
        return ArrayHelper::getValue($data, 'body', []) ?: [];
    }

    public function setBody($items, array $attributes = null)
    {
        if ($attributes) {
            foreach ($items as &$item) {
                $item = ArrayHelper::extractByKeys($item, $attributes);
            }
        }
        $data = $this->getItems();
        $data['body'] = $items ?: [];
        $this->setItems($data);
    }

    public function getTotal(): ?int
    {
        $data = $this->getItems();
        return ArrayHelper::getValue($data, 'meta.totalCount');
    }

    public function setTotal(?int $totalCount)
    {
        $data = $this->getItems();
        ArrayHelper::setValue($data, 'meta.totalCount', $totalCount);
        $this->setItems($data);
    }

    protected function getItems(): array
    {
        $store = new StoreFile($this->fileName());
        $data = $store->load() ?: [];
        return $data;
    }

    protected function setItems(array $items)
    {
        $store = new StoreFile($this->fileName());
        $store->save($items);
    }
}
