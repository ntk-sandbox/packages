<?php

namespace Untek\Framework\Rpc\Domain\Repositories\File;

use Untek\Core\FileSystem\Helpers\FilePathHelper;
use Untek\Core\FileSystem\Helpers\FindFileHelper;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\Collection\Libs\Collection;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Framework\Rpc\Domain\Entities\DocEntity;
use Untek\Framework\Rpc\Domain\Interfaces\Repositories\DocsRepositoryInterface;
use Untek\Component\Web\Html\Helpers\HtmlHelper;

class DocsRepository implements DocsRepositoryInterface
{

    public function findOneByName(string $name): DocEntity
    {
        $collection = $this->findAll();
        foreach ($collection as $entity) {
            if ($entity->getName() == $name) {
                return $entity;
            }
        }
        throw new NotFoundException();
    }

    /**
     * @return Enumerable | DocEntity[]
     */
    public function findAll(): Enumerable
    {
        $dir = $this->distDirectory();
        $files = FindFileHelper::scanDir($dir);
        $collection = new Collection();
        foreach ($files as &$file) {
            if (FilePathHelper::fileExt($file) == 'html') {
                $name = str_replace('.html', '', $file);
                $fileName = $dir . '/' . $file;
                $htmlCode = file_get_contents($fileName);
                $title = HtmlHelper::getTagContent($htmlCode, 'title');
                $title = str_replace('API documentation', '', $title);
                $entity = new DocEntity();
                $entity->setName($name);
                $entity->setTitle($title);
                $entity->setFileName($fileName);
                $collection->add($entity);
            }
        }
        return $collection;
    }

    public function loadByName(string $name): string
    {
        $file = $name . '.html';
        $docsFile = $this->distDirectory() . '/' . $file;
        $docsHtml = file_get_contents($docsFile);
        return $docsHtml;
    }

    private function distDirectory(): string
    {
        $rootDirectory = __DIR__ . '/../../../../../../../../..';
        $docsPath = 'docs/api/dist';
        return $rootDirectory . '/' . $docsPath;
    }
}
