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
    protected string $pathToIsolated;
    protected string $kernelClass;

    public function __construct(IsolateEncoder $encoder, string $pathToIsolated = null, string $kernelClass = null)
    {
        $this->encoder = $encoder;
        $this->pathToIsolated = $pathToIsolated ?: __DIR__ . '/../../../../../../untek-sandbox/sandbox/src/WebTest/resouces/bin';
        $this->kernelClass = $kernelClass ?: \App\Application\Common\Libs\HttpServer::class;
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
            "--kernel" => $this->kernelClass,
            $encodedRequest
        ];
        $commandString = CommandLineHelper::argsToString($command);
        $cwd = realpath($this->pathToIsolated);
//        dd($commandString, $cwd);
        $process = Process::fromShellCommandline($commandString, $cwd);
        $res = $process->run();
        $encodedResponse = $process->getOutput();
//        dd($process->getErrorOutput());
        return $encodedResponse;
    }
}
