<?php

namespace ZnSandbox\Sandbox\WebTest\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ZnFramework\Console\Domain\Libs\ZnShell;

class SendRestRequestCommand extends BaseCommand
{

    protected static $defaultName = 'http:request:send';

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

        $httpClient = $this->createHttpClient();
        $request = $httpClient->createRequest('POST', '/json-rpc', $jsonRpcRequest);
        $response = $this->handleRequest($request);
        $output->writeln($response->getContent());

        return 0;
    }

    protected function handleRequest(Request $request): Response
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
                $encodedRequest
            ]
        )->getOutput();
        return $encodedResponse;
    }
}
