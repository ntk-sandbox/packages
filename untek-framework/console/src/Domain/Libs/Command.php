<?php

namespace Untek\Framework\Console\Domain\Libs;

class Command
{

    private $commands = [];

    public function add(string $cmd): self {
        $this->commands[] = $cmd;
        return $this;
    }

    public function toString() {
        return implode(' && ', $this->commands);
    }
}
