<?php

namespace Untek\Sandbox\Sandbox\RestApiOpenApi\Domain\Dto;

class ResponsetDto
{

    public int $statusCode;
    public mixed $body;
    public array $headers = [];

}
