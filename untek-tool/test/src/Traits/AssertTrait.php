<?php

namespace Untek\Tool\Test\Traits;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\FileSystem\Helpers\FileStorageHelper;
use Untek\Domain\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Core\Collection\Helpers\CollectionHelper;
use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\Lib\Components\Store\Helpers\StoreHelper;
use Untek\Tool\Test\Helpers\TestHelper;

trait AssertTrait
{

    protected function assertUnprocessibleEntityException($expected, UnprocessibleEntityException $e, bool $debug = false)
    {
        $errorCollection = $e->getErrorCollection();
        $arr = CollectionHelper::toArray($errorCollection);
        $this->assertArraySubset($expected, $arr);
    }

    public function assertCollection(array $expectedResult, Enumerable $collection)
    {
        $this->assertArraySubset($expectedResult, CollectionHelper::toArray($collection));
        $this->assertCount(count($expectedResult), $collection->getIterator());
        return $this;
    }

    /*public function assertUnprocessable(UnprocessibleEntityException $exception)
    {
        $errorCollection = $exception->getErrorCollection();
        $errors = ErrorCollectionHelper::collectionToArray($errorCollection);
        $this->assertArraySubset($err, $errors);
        return $this;
    }*/

    protected function assertEntity($expected, object $entity, string $instanceOf = null)
    {
        $arr = EntityHelper::toArray($entity);
        $this->assertArraySubset($expected, $arr);
        if ($instanceOf) {
            $this->assertInstanceOf($instanceOf, $entity);
        }
    }


    protected function assertArrayFromFile(string $exceptedFileName, array $actual, bool $rewrite = true)
    {
        $expected = StoreHelper::load($exceptedFileName);
        $expectedJson = json_encode($expected, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $actualJson = json_encode($actual, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        if ($expectedJson !== $actualJson && TestHelper::isRewriteData() && $rewrite) {
            StoreHelper::save($exceptedFileName, $actual);
        }
        $this->assertEqualsArray($expected, $actual);

    }

    protected function assertFromFile(string $exceptedFileName, string $actual, bool $rewrite = true)
    {
        $expected = FileStorageHelper::load($exceptedFileName);
//        $expectedJson = json_encode($expected, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
//        $actualJson = json_encode($actual, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        if ($expected !== $actual && TestHelper::isRewriteData() && $rewrite) {
            FileStorageHelper::save($exceptedFileName, $actual);
        }
        $this->assertEquals($expected, $actual);
    }

    protected function assertEqualsArray($expected, $actual)
    {
        $this->assertEquals(json_encode($expected, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), json_encode($actual, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
}