<?php

namespace ZnSandbox\Sandbox\RestApiOpenApi\Domain\Dto;

class RequestDto
{

    public string $method = 'GET';
    public string $uri;
    public mixed $body;
    public array $headers = [];
    public ResponsetDto $response;

}
