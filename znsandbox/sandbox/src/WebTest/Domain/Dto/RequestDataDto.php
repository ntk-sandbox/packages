<?php

namespace Untek\Sandbox\Sandbox\WebTest\Domain\Dto;

class RequestDataDto
{

    public string|null $method = null;
    public string|null $uri = null;
    public array|null $data = null;
    public array $headers = [];
    public string|null $content = null;
    public array $parameters = [];
    public array $cookies = [];
    public array $files = [];
    public array $server = [];

    public function __construct(array $data = null)
    {
        foreach ($data as $name => $value) {
            $this->{$name} = $value;
        }
    }

    public function toArray(): array
    {
        $result = [];
        foreach ($this as $name => $value) {
            $result[$name] = $value;
        }
        return $result;
    }
}
