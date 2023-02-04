<?php

namespace Untek\Framework\Rpc\Domain\Repositories\File;

use Untek\Framework\Rpc\Domain\Interfaces\Repositories\DocsRepositoryInterface;

class DocsRepository implements DocsRepositoryInterface
{

    public function loadByName(string $name): string
    {
        $rootDirectory = __DIR__ . '/../../../../../../../../..';
        $docsPath = 'docs/api/dist';
        $file = 'index-for-' . $name . '.html';
        $docsFile = $rootDirectory . '/' . $docsPath . '/' . $file;
        $docsHtml = file_get_contents($docsFile);
        return $docsHtml;
    }
}
