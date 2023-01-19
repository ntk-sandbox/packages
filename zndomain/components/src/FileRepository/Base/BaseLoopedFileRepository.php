<?php

namespace ZnDomain\Components\FileRepository\Base;

use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnDomain\Components\FileRepository\Base\BaseFileCrudRepository;
use ZnDomain\Entity\Helpers\EntityHelper;

abstract class BaseLoopedFileRepository extends BaseFileCrudRepository
{

    public $limitItems = 3;

    public function oneLast(): object
    {
        $all = $this->findAll();
        if(!$all->isEmpty()) {
            return $this->findAll()->last();
        }
        throw new NotFoundException();
    }

    protected function insert(object $entity) {
        $items = $this->getItems();
        $items[] = EntityHelper::toArray($entity);
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
