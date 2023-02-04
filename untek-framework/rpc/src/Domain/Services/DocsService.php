<?php

namespace Untek\Framework\Rpc\Domain\Services;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Framework\Rpc\Domain\Entities\DocEntity;
use Untek\Framework\Rpc\Domain\Helpers\DocContentHelper;
use Untek\Framework\Rpc\Domain\Interfaces\Repositories\DocsRepositoryInterface;
use Untek\Framework\Rpc\Domain\Interfaces\Services\DocsServiceInterface;

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
