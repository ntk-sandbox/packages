<?php

namespace ZnSandbox\Sandbox\WebTest\Domain\Facades;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelBrowser;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\ConsoleHttpKernel;

class TestHttpFacade
{

    public static function handleRequest(Request $request): Response
    {
        $httpKernel = new ConsoleHttpKernel();
        $httpKernelBrowser = new HttpKernelBrowser($httpKernel);
        $httpKernelBrowser->request(
            $request->getMethod(),
            $request->getUri(),
            [],
            [],
            $request->server->all(),
            $request->getContent()
        );
        return $httpKernelBrowser->getResponse();
    }
}
