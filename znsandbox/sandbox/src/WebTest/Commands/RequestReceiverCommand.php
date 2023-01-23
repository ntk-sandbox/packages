<?php

namespace ZnSandbox\Sandbox\WebTest\Commands;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ZnSandbox\Sandbox\WebTest\Domain\Encoders\IsolateEncoder;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\BaseHttpKernelFactory;
use ZnSandbox\Sandbox\WebTest\Domain\Services\HttpRequestService;

/**
 * Обработчик изолированных HTTP-запросов.
 *
 * Опция factory-class указывает на класс фабрики HTTP-приложения.
 *
 * Аргумент request содержит сериализованный HTTP-запрос.
 * Сериализация/десериализвация выполняется в 2 шага:
 *
 * - Сериализация объекта Request (функция serialize).
 * - Кодирование в формат Base 64.
 *
 * Пример команды:
 *
 * php isolated http:request:run --factory-class="App\Application\Common\Factories\HttpKernelFactory" "Tzo0MDoiU39ueV1wb...vdW5R25cUmVxdWV"
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
            'factory-class',
            null,
            InputOption::VALUE_REQUIRED,
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $factoryClass = $input->getOption('factory-class');
        $encodedRequest = $input->getArgument('request');
        $requestEncoder = new IsolateEncoder();
        /** @var Request $request */
        $request = $requestEncoder->decode($encodedRequest);
        $this->fixSessionIdBeforeHandle($request);

        /** @var BaseHttpKernelFactory $kernelFactory */
        $kernelFactory = $this->container->get($factoryClass);
        $httpKernel = $kernelFactory->createKernelInstance($request);
        $response = $httpKernel->handle($request);

        /*$response = $this
            ->getService($factoryClass)
            ->handle($request);*/
        $this->fixSessionIdAfterHandle($request, $response);
        $encodedResponse = $requestEncoder->encode($response);
        $output->write($encodedResponse);
        return Command::SUCCESS;
    }

    protected function getService(string $factoryClass): HttpRequestService
    {
        /** @var BaseHttpKernelFactory $kernelFactory */
        $kernelFactory = $this->container->get($factoryClass);
        return new HttpRequestService($kernelFactory);
    }

    /**
     * Фикс недостающего session_id.
     *
     * Такая проблема проявляется только под CLI.
     *
     * @param Request $request
     */
    protected function fixSessionIdBeforeHandle(Request $request): void
    {
        $clientSessId = $request->cookies->get('PHPSESSID');
        if ($clientSessId) {
            session_id($clientSessId);
        }
    }

    /**
     * Фиск: добавление ID сесси в куки ответа.
     *
     * Такая проблема проявляется только под CLI.
     *
     * @param Request $request
     * @param Response $response
     */
    protected function fixSessionIdAfterHandle(Request $request, Response $response): void
    {
        $clientSessId = $request->cookies->get('PHPSESSID');
        if (session_id() != $clientSessId) {
            $response->headers->set('Set-Cookie', "PHPSESSID=" . session_id() . "; path=/");
        }
    }
}
