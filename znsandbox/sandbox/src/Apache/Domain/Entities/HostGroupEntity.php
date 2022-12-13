<?php

namespace ZnSandbox\Sandbox\Apache\Domain\Entities;

class HostGroupEntity {

    private $tagName;
    private $config;

    public function getTagName()
    {
        return $this->tagName;
    }

    public function setTagName($tagName): void
    {
        $this->tagName = $tagName;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function setConfig($config): void
    {
        $this->config = $config;
    }

}
