<?php

namespace Untek\Sandbox\Sandbox\WebTest\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelBrowser;
use Untek\Core\Container\Helpers\ContainerHelper;
use Untek\Framework\Console\Domain\Libs\ZnShell;
use Untek\Sandbox\Sandbox\WebTest\Domain\Encoders\IsolateEncoder;
use Untek\Sandbox\Sandbox\WebTest\Domain\Libs\BaseHttpKernelFactory;
use Untek\Sandbox\Sandbox\WebTest\Domain\Libs\ConsoleHttpKernel;
use Untek\Sandbox\Sandbox\WebTest\Domain\Libs\HttpClient;
use Untek\Sandbox\Sandbox\WebTest\Domain\Libs\Plugins\JsonAuthPlugin;
use Untek\Sandbox\Sandbox\WebTest\Domain\Libs\Plugins\JsonPlugin;

class SendRestRequestCommand extends Command
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
//        $jsonAuthPlugin->withToken('qwerty123456');

        /** @var JsonPlugin $jsonPlugin */
        $jsonPlugin = $httpClient->getPlugin(JsonPlugin::class);
        $jsonPlugin->asJson();

        $request = $httpClient->createRequest('POST', '/json-rpc', $data);
        $response = $this->handleRequest($request);
        $output->writeln($response->getContent());

        return Command::SUCCESS;
    }

    protected function handleRequest(Request $request): Response
    {
        $requestEncoder = new IsolateEncoder();
        $httpKernel = new ConsoleHttpKernel($requestEncoder);
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
                "--kernel" => \App\Application\Common\Libs\HttpServer::class,
                $encodedRequest,
            ]
        )->getOutput();
        return $encodedResponse;
    }*/
}
