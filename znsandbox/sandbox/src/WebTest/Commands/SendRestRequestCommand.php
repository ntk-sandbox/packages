<?php

namespace ZnSandbox\Sandbox\WebTest\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelBrowser;
use ZnCore\Container\Helpers\ContainerHelper;
use ZnFramework\Console\Domain\Libs\ZnShell;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\AppFactory;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\ConsoleHttpKernel;

//use Symfony\Component\BrowserKit\HttpBrowser;

class SendRestRequestCommand extends BaseCommand
{

    protected static $defaultName = 'http:request:send';

//    protected AppFactory $appFactory;

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $jsonRpcRequest = [
            "jsonrpc" => "2.0",
            "method" => "authentication.getTokenByPassword",
            'params' => [
                'body' => [
                    'login' => 'admin',
                    'password' => 'Wwwqqq111',
                ],
            ],
        ];

//        $container = ContainerHelper::getContainer();
//        $this->appFactory = new \App\Application\Common\Factories\AppFactory($container);

        $httpClient = $this->createHttpClient(/*$this->appFactory*/);
        $request = $httpClient->createRequest('POST', '/json-rpc', $jsonRpcRequest);
        $response = $this->handleRequest($request);
        $output->writeln($response->getContent());

        return 0;
    }

    protected function handleRequest(Request $request): Response
    {
        $httpKernel = new ConsoleHttpKernel($this->createEncoder());
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

    /*protected function handleRequest____(Request $request): Response
    {
        $requestEncoder = $this->createEncoder();
        $encodedRequest = $requestEncoder->encode($request);
        $encodedResponse = $this->runConsoleCommand($encodedRequest);
        $response = $requestEncoder->decode($encodedResponse);
        return $response;
    }

    protected function runConsoleCommand(string $encodedRequest): string
    {
        $shell = new ZnShell();
        $encodedResponse = $shell->runProcess(
            [
                'http:request:run',
                "--factory-class" => \App\Application\Common\Factories\AppFactory::class,
                $encodedRequest,
            ]
        )->getOutput();
        return $encodedResponse;
    }*/
}
