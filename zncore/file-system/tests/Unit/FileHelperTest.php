<?php

namespace ZnCore\Base\Tests\Unit;

use ZnCore\Collection\Helpers\CollectionHelper;
use ZnCore\FileSystem\Helpers\FindFileHelper;
use ZnCore\FileSystem\Helpers\MimeTypeHelper;
use ZnTool\Test\Asserts\DataAssert;
use ZnTool\Test\Asserts\DataTestCase;

final class FileHelperTest extends DataTestCase
{

    public function testScanDirTree()
    {
        $tree = FindFileHelper::scanDirTree(__DIR__ . '/../data/scanDirTree/i18next');
        $array = CollectionHelper::toArray($tree);
        $expected = $this->loadFromJsonFile(__DIR__ . '/../data/FileHelper/testScanDirTree.json');
        $this->assertArraySubset($expected, $array);
    }

    public function testGetMimeTypes()
    {
        $types = MimeTypeHelper::getMimeTypesByExt('json');

        $this->assertEquals([
            "application/json",
            "application/schema+json",
        ], $types);
    }

    public function testGetMimeType()
    {
        $types = MimeTypeHelper::getMimeTypeByExt('json');

        $this->assertEquals("application/json", $types);
    }

    public function testGetExtensions()
    {
        $extensions = MimeTypeHelper::getExtensionsByMime('application/json');

        $this->assertEquals([
            'json',
            'map',
        ], $extensions);
    }

    public function testGetExtension()
    {
        $extensions = MimeTypeHelper::getExtensionByMime('application/json');

        $this->assertEquals('json', $extensions);
    }
}
