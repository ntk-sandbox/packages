<?php

namespace ZnSandbox\Sandbox\WebTest\Domain\Facades;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelBrowser;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Process\PhpProcess;
use ZnSandbox\Sandbox\WebTest\Domain\Encoders\IsolateEncoder;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\ConsoleHttpKernel;

class TestHttpFacade
{

    public static function createHttpKernel(): HttpKernelInterface
    {
        $encoder = new IsolateEncoder();
        return new ConsoleHttpKernel($encoder);
    }

    private static function createHttpKernelBrowser(): HttpKernelBrowser
    {
        $httpKernel = self::createHttpKernel();
        $httpKernelBrowser = new HttpKernelBrowser($httpKernel);
        $httpKernelBrowser->followRedirects();
        return $httpKernelBrowser;
    }

//    public static function handleRequest(Request $request): Response
//    {
////        $kernel = self::createHttpKernel();
////        return $kernel->handle($request);
//
//        $httpKernelBrowser = self::createHttpKernelBrowser();
//        $httpKernelBrowser->request(
//            $request->getMethod(),
//            $request->getUri(),
//            $request->request->all(),
//            [],
//            $request->server->all(),
//            $request->getContent()
//        );
//        return $httpKernelBrowser->getResponse();
//    }

    public static function handleRequestViaIsolateKernel(Request $request): Response
    {
        $kernel = self::createHttpKernel();
        return $kernel->handle($request);
    }

    public static function handleRequestViaBrowser(Request $request): Response
    {
        $httpKernelBrowser = self::createHttpKernelBrowser();
        $httpKernelBrowser->request(
            $request->getMethod(),
            $request->getUri(),
            $request->request->all(),
            [],
            $request->server->all(),
            $request->getContent()
        );
        return $httpKernelBrowser->getResponse();
    }

    public static function handleRequestViaPhpProcess(Request $request, string $kernelFactory, array $env = []): Response
    {
        $serializedRequest = var_export(serialize($request), true);
//        $kernelFactory = \App\Application\Common\Factories\HttpKernelFactory::class;

        $serializedEnv = var_export(serialize($env), true);

        $code = <<<EOF
<?php

use Symfony\Component\Console\Application;
use ZnCore\App\Libs\ZnCore;
use ZnCore\Container\Libs\Container;
use ZnSandbox\Sandbox\WebTest\Commands\RequestReceiverCommand;

\$_SERVER['MICRO_TIME'] = microtime(true);

require __DIR__ . '/vendor/autoload.php';

\$container = new Container();
\$znCore = new ZnCore(\$container);
\$znCore->init();

\$request = unserialize($serializedRequest);

\$appFactory = new $kernelFactory(\$container);
\$env = unserialize($serializedEnv);
foreach(\$env as \$key => \$value) {
    putenv(\$key . '=' . \$value);
}
\$framework = \$appFactory->createKernelInstance(\$request);

\$response = \$framework->handle(\$request);

echo serialize(\$response);

EOF;

        $process = new PhpProcess($code);
        $process->run();
        $serializedResponse = $process->getOutput();
        $response = unserialize($serializedResponse);
        return $response;
    }
}
