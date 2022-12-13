<?php

namespace ZnBundle\Notify\Domain\Repositories\File;

use ZnCore\Code\Helpers\DeprecateHelper;
use ZnDomain\Components\FileRepository\Base\BaseFileCrudRepository;
use ZnDomain\Entity\Helpers\EntityHelper;

DeprecateHelper::hardThrow();

abstract class BaseRepository extends BaseFileCrudRepository
{

    public $limitItems = 3;

    public function oneLast(): object
    {
        return $this->findAll()->last();
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
