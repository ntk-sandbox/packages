<?php

namespace ZnSandbox\Sandbox\WebTest\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelBrowser;
use ZnCore\Container\Helpers\ContainerHelper;
use ZnFramework\Console\Domain\Libs\ZnShell;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\BaseHttpKernelFactory;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\ConsoleHttpKernel;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\HttpClient;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\Plugins\JsonAuthPlugin;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\Plugins\JsonPlugin;

class SendRestRequestCommand extends BaseCommand
{

    protected static $defaultName = 'http:request:send';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $data = [
            "jsonrpc" => "2.0",
            "method" => "authentication.getTokenByPassword",
            'params' => [
                'body' => [
                    'login' => 'admin',
                    'password' => 'Wwwqqq111',
                ],
            ],
        ];

        $httpClient = new HttpClient();
        $httpClient->addPlugin(new JsonPlugin());
        $httpClient->addPlugin(new JsonAuthPlugin());

        /** @var JsonAuthPlugin $jsonAuthPlugin */
        $jsonAuthPlugin = $httpClient->getPlugin(JsonAuthPlugin::class);
//        $jsonAuthPlugin->withToken('asdadasdasdsa');

        /** @var JsonPlugin $jsonPlugin */
        $jsonPlugin = $httpClient->getPlugin(JsonPlugin::class);
        $jsonPlugin->asJson();

        $request = $httpClient->createRequest('POST', '/json-rpc', $data);
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
                "--factory-class" => \App\Application\Common\Factories\HttpKernelFactory::class,
                $encodedRequest,
            ]
        )->getOutput();
        return $encodedResponse;
    }*/
}
