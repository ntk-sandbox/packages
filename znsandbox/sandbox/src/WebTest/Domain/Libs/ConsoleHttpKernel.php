<?php

namespace ZnSandbox\Sandbox\WebTest\Domain\Libs;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use ZnCore\Collection\Libs\Collection;
use ZnCore\Contract\Encoder\Interfaces\EncoderInterface;
use ZnFramework\Console\Domain\Libs\ZnShell;
use ZnLib\Components\Format\Encoders\ChainEncoder;
use ZnLib\Components\Format\Encoders\PhpSerializeEncoder;
use ZnLib\Components\Format\Encoders\SafeBase64Encoder;

class ConsoleHttpKernel implements HttpKernelInterface
{

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
                "--factory-class" => \App\Application\Common\Factories\HttpKernelFactory::class,
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
