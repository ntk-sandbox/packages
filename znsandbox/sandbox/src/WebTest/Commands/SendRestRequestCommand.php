<?php

namespace ZnSandbox\Sandbox\WebTest\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelBrowser;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use ZnCore\Collection\Libs\Collection;
use ZnCore\Contract\Encoder\Interfaces\EncoderInterface;
use ZnFramework\Console\Domain\Libs\ZnShell;
use ZnLib\Components\Format\Encoders\ChainEncoder;
use ZnLib\Components\Format\Encoders\PhpSerializeEncoder;
use ZnLib\Components\Format\Encoders\SafeBase64Encoder;

//use Symfony\Component\BrowserKit\HttpBrowser;

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
        $httpKernel = new ConsoleHttpKernel($this->createEncoder());
        $httpKernelBrowser = new HttpKernelBrowser($httpKernel);
        $httpKernelBrowser->request($request->getMethod(), $request->getUri(), [], [], $request->server->all(), $request->getContent());
        return $httpKernelBrowser->getResponse();   
    }

    protected function handleRequest____(Request $request): Response
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


class ConsoleHttpKernel implements HttpKernelInterface {
    
    protected EncoderInterface $encoder;
    
    public function __construct()
    {
        $this->encoder = $this->createEncoder();
    }

    public function handle(Request $request, int $type = self::MAIN_REQUEST, bool $catch = true): Response
    {
        $encodedRequest = $this->encoder->encode($request);
        $encodedResponse = $this->runConsoleCommand($encodedRequest);
        $response = $this->encoder->decode($encodedResponse);
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

    protected function createEncoder()
    {
        $requestEncoder = new ChainEncoder(
            new Collection(
                [
                    new PhpSerializeEncoder(),
                    new SafeBase64Encoder(),
                ]
            )
        );
        return $requestEncoder;
    }
}
