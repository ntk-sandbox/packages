<?php

namespace Untek\Sandbox\Sandbox\WebTest\Commands;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use Untek\Sandbox\Sandbox\WebTest\Domain\Encoders\IsolateEncoder;
use Untek\Sandbox\Sandbox\WebTest\Domain\Helpers\IsolateFixerHelper;
use Untek\Sandbox\Sandbox\WebTest\Domain\Libs\BaseHttpKernelFactory;
use Untek\Sandbox\Sandbox\WebTest\Domain\Services\HttpRequestService;

/**
 * Обработчик изолированных HTTP-запросов.
 *
 * Опция kernel указывает на класс HTTP-приложения.
 *
 * Аргумент request содержит сериализованный HTTP-запрос.
 * Сериализация/десериализвация выполняется в 2 шага:
 *
 * - Сериализация объекта Request (функция serialize).
 * - Кодирование в формат Base 64.
 *
 * Пример команды:
 *
 * php isolated http:request:run --kernel="App\Application\Common\Libs\HttpServer" "Tzo0MDoiU39ueV1wb...vdW5R25cUmVxdWV"
 */
class RequestReceiverCommand extends Command
{

    protected static $defaultName = 'http:request:run';

    private HttpRequestService $httpRequestService;

    public function __construct(private ContainerInterface $container)
    {
        parent::__construct();
    }

    public function getDescription()
    {
        return 'Isolated HTTP request handler.';
    }

    protected function configure()
    {
        $this->addArgument('request', InputArgument::REQUIRED);
        $this->addOption(
            'kernel',
            null,
            InputOption::VALUE_REQUIRED,
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $kernelClass = $input->getOption('kernel');
        $encodedRequest = $input->getArgument('request');
        $requestEncoder = new IsolateEncoder();
        /** @var Request $request */
        $request = $requestEncoder->decode($encodedRequest);

        /** @var HttpKernelInterface | TerminableInterface $server */
        $server = $this->container->get($kernelClass);
        $response = $this->handleRequest($request, $server);

        $encodedResponse = $requestEncoder->encode($response);
        $output->write($encodedResponse);
        $server->terminate($request, $response);
        return Command::SUCCESS;
    }

    private function handleRequest(Request $request, HttpKernelInterface|TerminableInterface $server): Response
    {
        IsolateFixerHelper::fixBeforeHandle($request);
        $response = $server->handle($request);
        IsolateFixerHelper::fixAfterHandle($request, $response);
        return $response;
    }

    private function handle(Request $request, string $factoryClass): Response
    {
        IsolateFixerHelper::fixBeforeHandle($request);
        /** @var BaseHttpKernelFactory $kernelFactory */
        $kernelFactory = $this->container->get($factoryClass);
        $httpKernel = $kernelFactory->createKernelInstance($request);
        $response = $httpKernel->handle($request);
        IsolateFixerHelper::fixAfterHandle($request, $response);
        return $response;
    }
}
