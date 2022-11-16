<?php

namespace ZnSandbox\Sandbox\Apache\Domain\Entities;

class ServerEntity {

    private $id;
    private $tagName;
    private $tagAttributes;
    private $config;
    private $hosts;
    private $serverName;
    private $documentRoot;

    public function getId()
    {
        return $this->getServerName();
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getTagName()
    {
        return $this->tagName;
    }

    public function setTagName($tagName): void
    {
        $this->tagName = $tagName;
    }

    public function getTagAttributes()
    {
        return $this->tagAttributes;
    }

    public function setTagAttributes($tagAttributes): void
    {
        $this->tagAttributes = $tagAttributes;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function setConfig($config): void
    {
        $this->config = $config;
    }

    public function getHosts(): ?HostEntity
    {
        return $this->hosts;
    }

    public function setHosts(HostEntity $hosts): void
    {
        $this->hosts = $hosts;
    }

    public function getServerName()
    {
        return $this->config['ServerName'];
    }

    public function setServerName($serverName): void
    {
        //$this->serverName = $serverName;
    }

    public function getDocumentRoot()
    {
        return $this->config['DocumentRoot'];
    }

    public function setDocumentRoot($documentRoot): void
    {
        //$this->documentRoot = $documentRoot;
    }

}
