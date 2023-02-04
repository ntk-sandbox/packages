<?php

namespace Untek\Domain\Components\FileRepository\Base;

use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Domain\Components\FileRepository\Base\BaseFileCrudRepository;
use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\Domain\Repository\Traits\RepositoryMapperTrait;

abstract class BaseLoopedFileRepository extends BaseFileCrudRepository
{

    use RepositoryMapperTrait;

    public $limitItems = 3;

    public function oneLast(): object
    {
        $all = $this->findAll();
        if(!$all->isEmpty()) {
            return $this->findAll()->last();
        }
        throw new NotFoundException();
    }

    public function truncate(): void {
        parent::setItems([]);
    }

    protected function insert(object $entity) {
        $items = $this->getItems();
//        $item = $this->mapperEncodeEntity($entity);
        $item = EntityHelper::toArray($entity);
        $items[] = $item;
        $this->setItems($items);
    }

    protected function setItems(array $items)
    {
        $items = $this->cleanByLimit($items);
        return parent::setItems($items);
    }

    private function cleanByLimit(array $items) {
        $count = count($items);
        if($count > $this->limitItems) {
            $items = array_slice($items,  $count - $this->limitItems, $this->limitItems);
        }
        return $items;
    }
}
