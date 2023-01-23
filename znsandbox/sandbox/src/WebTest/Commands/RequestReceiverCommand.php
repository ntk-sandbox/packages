<?php

namespace ZnSandbox\Sandbox\WebTest\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelBrowser;
use ZnCore\Container\Helpers\ContainerHelper;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\BaseHttpKernelFactory;

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
class RequestReceiverCommand extends BaseCommand
{

    protected static $defaultName = 'http:request:run';

    protected string $factoryClass;
    protected BaseHttpKernelFactory $appFactory;

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
        $container = ContainerHelper::getContainer();
        $this->appFactory = $container->get($factoryClass);

        $encodedRequest = $input->getArgument('request');
        $requestEncoder = $this->createEncoder();
        /** @var Request $request */
        $request = $requestEncoder->decode($encodedRequest);

        $clientSessId = $request->cookies->get('PHPSESSID');
        if ($clientSessId) {
            session_id($clientSessId);
        }

        $response = $this->handleRequest($request);

//        file_put_contents(__DIR__ . '/../../../../../../../../var/qqq_'.date("Y.m.d_H:i:s_u") . '_' .$request->getMethod() . '_' . $response->getStatusCode().'.html', $response->getContent());

        /*file_put_contents(
            __DIR__ . '/../../../../../../../../var/qqq_' . date("Y.m.d_H:i:s") . '_' . mt_rand(100, 999) . '.json',
            json_encode($request->getMethod(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );*/


        if (session_id() != $clientSessId) {
            $response->headers->set('Set-Cookie', "PHPSESSID=" . session_id() . "; path=/");
        }

        $encodedResponse = $requestEncoder->encode($response);
        $output->write($encodedResponse);

        return 0;
    }

    protected function handleRequest(Request $request): Response
    {
        $httpKernel = $this->appFactory->createKernelInstance($request);
        $httpKernelBrowser = new HttpKernelBrowser($httpKernel);

        $httpKernelBrowser->request(
            $request->getMethod(),
            $request->getUri(),
            $request->request->all(),
            [],
            $request->server->all(),
            $request->getContent() // json_encode($request->request->all())
        );
        return $httpKernelBrowser->getResponse();
    }
}
