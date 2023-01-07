<?php

namespace ZnSandbox\Sandbox\WebTest\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestReceiverCommand extends BaseCommand
{

    protected static $defaultName = 'http:request:run';

    protected function configure()
    {
        $this->addArgument('request', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $encodedRequest = $input->getArgument('request');
        $requestEncoder = $this->createEncoder();
        $request = $requestEncoder->decode($encodedRequest);
        $response = $this->handleRequest($request);

//        $response = $httpClient->postJson('/json-rpc', $jsonRpcRequest);

        $encodedResponse = $requestEncoder->encode($response);
        $output->write($encodedResponse);

        return 0;
    }

    protected function handleRequest(Request $request): Response
    {
        $httpClient = $this->createHttpClient();
        $response = $httpClient->handleRequest($request);
        return $response;
    }
}
