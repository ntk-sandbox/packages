<?php

namespace ZnFramework\Rpc\Domain\Services;

use ZnCore\Collection\Interfaces\Enumerable;
use ZnFramework\Rpc\Domain\Entities\DocEntity;
use ZnFramework\Rpc\Domain\Helpers\DocContentHelper;
use ZnFramework\Rpc\Domain\Interfaces\Repositories\DocsRepositoryInterface;
use ZnFramework\Rpc\Domain\Interfaces\Services\DocsServiceInterface;

class DocsService implements DocsServiceInterface
{

    private $docsRepository;

    public function __construct(DocsRepositoryInterface $docsRepository)
    {
        $this->docsRepository = $docsRepository;
    }

    public function findOneByName(string $name): DocEntity
    {
        return $this->docsRepository->findOneByName($name);
    }

    public function findAll(): Enumerable
    {
        return $this->docsRepository->findAll();
    }

    public function loadByName(string $name): string
    {
        $docsHtml = $this->docsRepository->loadByName($name);
        $docsHtml = DocContentHelper::prepareHtml($docsHtml);
        return $docsHtml;
    }
}
