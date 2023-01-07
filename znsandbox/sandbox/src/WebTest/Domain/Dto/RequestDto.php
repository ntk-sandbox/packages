<?php

namespace ZnSandbox\Sandbox\WebTest\Domain\Dto;

use Symfony\Component\HttpFoundation\Request;

class RequestDto
{

    public Request $request;
    public array $apps;
}
