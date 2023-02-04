<?php

namespace Untek\Tool\Package\Commands;

use Untek\Tool\Package\Domain\Interfaces\Services\GitServiceInterface;
use Untek\Tool\Package\Domain\Interfaces\Services\PackageServiceInterface;
use Symfony\Component\Console\Command\Command;

abstract class BaseCommand extends Command
{

    protected $packageService;
    protected $gitService;

    public function __construct(PackageServiceInterface $packageService, GitServiceInterface $gitService)
    {
        parent::__construct(self::$defaultName);
        $this->packageService = $packageService;
        $this->gitService = $gitService;
    }

}
