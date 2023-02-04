<?php

namespace Untek\Sandbox\Sandbox\WebTest\Domain\Libs;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Process\Process;
use Untek\Core\Contract\Encoder\Interfaces\EncoderInterface;
use Untek\Framework\Console\Domain\Helpers\CommandLineHelper;
use Untek\Sandbox\Sandbox\WebTest\Domain\Encoders\IsolateEncoder;

class ConsoleHttpKernel implements HttpKernelInterface
{

    protected EncoderInterface $encoder;

    public function __construct(IsolateEncoder $encoder)
    {
        $this->encoder = $encoder;
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
        $command = [
            'php',
            'isolated',
            'http:request:run',
            "--kernel" => \App\Application\Common\Libs\HttpServer::class,
            $encodedRequest
        ];
        $commandString = CommandLineHelper::argsToString($command);
        $cwd = realpath(__DIR__ . '/../../../../../../untek-sandbox/sandbox/src/WebTest/resouces/bin');
        $process = Process::fromShellCommandline($commandString, $cwd);
        $res = $process->run();
        $encodedResponse = $process->getOutput();
        return $encodedResponse;
    }
}
