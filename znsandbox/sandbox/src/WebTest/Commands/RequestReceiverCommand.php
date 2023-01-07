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
use ZnSandbox\Sandbox\WebTest\Domain\Libs\AppFactory;

class RequestReceiverCommand extends BaseCommand
{

    protected static $defaultName = 'http:request:run';

    protected string $factoryClass;
    protected AppFactory $appFactory;

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

//        $response = $httpClient->postJson('/json-rpc', $jsonRpcRequest);
        $response = $this->handleRequest($request);
        $encodedResponse = $requestEncoder->encode($response);
        $output->write($encodedResponse);

        return 0;
    }

    protected function handleRequest(Request $request): Response
    {
        $httpKernel = $this->appFactory->createKernelInstance($request);
//        $httpKernel = $this->createHttpClient($this->appFactory)->createKernelInstance($request);
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

    /*protected function handleRequest_______________(Request $request): Response
    {
        $httpClient = $this->createHttpClient($this->appFactory);
        $response = $httpClient->handleRequest($request);
        return $response;
    }*/
}
