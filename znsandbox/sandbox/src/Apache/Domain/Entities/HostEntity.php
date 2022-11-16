<?php

namespace ZnSandbox\Sandbox\Apache\Domain\Entities;

class HostEntity {

    private $ip;
    private $host;
    private $categoryName;
    private $url;

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip): void
    {
        $this->ip = $ip;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function setHost($host): void
    {
        $this->host = $host;
    }

    public function getCategoryName()
    {
        return $this->categoryName;
    }

    public function setCategoryName($categoryName): void
    {
        $this->categoryName = $categoryName;
    }

    public function getUrl()
    {
        return 'http://' . $this->host;
    }
}
