<?php

namespace ZnLib\Components\ShellRobot\Domain\Base;

use ZnLib\Components\ShellRobot\Domain\Libs\Shell\LocalShell;
use ZnFramework\Console\Domain\Base\BaseShellNew;
use ZnFramework\Console\Domain\Libs\IO;

abstract class BaseShell
{

    protected $localShell;
    protected $remoteShell;
    protected $io;
    protected $title;

    public function getTitle(): ?string
    {
        if ($this->title == null) {
            return static::class;
        }
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function __construct(BaseShellNew $remoteShell, IO $io)
    {
        $this->localShell = new LocalShell();
        $this->remoteShell = $remoteShell;
        $this->io = $io;
    }
}
