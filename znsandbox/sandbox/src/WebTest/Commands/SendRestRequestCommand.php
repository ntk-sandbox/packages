<?php

namespace ZnSandbox\Sandbox\WebTest\Commands;

use App\Application\Admin\Libs\AdminApp;
use App\Application\Rpc\Libs\RpcApp;
use App\Application\Web\Libs\WebApp;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Response;
use ZnCore\Collection\Libs\Collection;
use ZnCore\Container\Helpers\ContainerHelper;
use ZnCrypt\Base\Domain\Helpers\SafeBase64Helper;
use ZnCrypt\Base\Domain\Libs\Encoders\CollectionEncoder;
use ZnFramework\Console\Domain\Libs\ZnShell;
use ZnLib\Components\Format\Encoders\ChainEncoder;
use ZnLib\Components\Format\Encoders\PhpSerializeEncoder;
use ZnLib\Components\Format\Encoders\SafeBase64Encoder;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\AppFactory;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\JsonHttpClient;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\HttpClient;

class SendRestRequestCommand extends BaseCommand
{

    protected static $defaultName = 'http:request:send';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<fg=white># Send request</>');

        $httpClient = $this->createHttpClient();

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

        $request = $httpClient->createRequest('POST', '/json-rpc', $jsonRpcRequest);

        $requestEncoder = $this->createEncoder();

        $encodedRequest = $requestEncoder->encode($request);

        $encodedResponse = $this->runConsoleCommand($encodedRequest);

        $response = $requestEncoder->decode($encodedResponse);

        $output->writeln($response->getContent());
        return 0;
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
