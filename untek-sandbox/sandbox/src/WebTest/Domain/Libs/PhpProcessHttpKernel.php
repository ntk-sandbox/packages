<?php

namespace Untek\Sandbox\Sandbox\WebTest\Domain\Libs;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Untek\Sandbox\Sandbox\WebTest\Domain\Facades\TestHttpFacade;

class PhpProcessHttpKernel implements HttpKernelInterface
{

    public function handle(Request $request, int $type = self::MAIN_REQUEST, bool $catch = true): Response
    {
        $request = Request::create(
            $request->getUri(),
            $request->getMethod(),
            $request->request->all(),
            $request->cookies->all(),
            $request->files->all(),
            $request->server->all()
        );
        $response = TestHttpFacade::handleRequestViaPhpProcess($request);
        return $response;
    }
}
