<?php

namespace ZnSandbox\Sandbox\WebTest\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelBrowser;

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
        /** @var Request $request */
        $request = $requestEncoder->decode($encodedRequest);

//        $browser = new \Symfony\Component\BrowserKit\HttpBrowser(HttpClient::create());
//        $crawler = $browser->request('GET', $_ENV['WEB_URL']);
//        dd($crawler->outerHtml());
        
//        $response = $httpClient->postJson('/json-rpc', $jsonRpcRequest);
        $response = $this->handleRequest($request);
        $encodedResponse = $requestEncoder->encode($response);
        $output->write($encodedResponse);

        return 0;
    }

    protected function handleRequest(Request $request): Response
    {
        $httpKernel = $this->createHttpClient()->createKernelInstance($request);
        $httpKernelBrowser = new HttpKernelBrowser($httpKernel);
//        $httpKernelBrowser = new \Symfony\Component\BrowserKit\HttpBrowser(HttpClient::create());
//        dd($request->getContent());
        $httpKernelBrowser->request($request->getMethod(), $request->getUri(), [], [], $request->server->all(), $request->getContent());
//        $httpKernelBrowser->jsonRequest($request->getMethod(), $request->getUri(), json_decode($request->getContent(), JSON_OBJECT_AS_ARRAY), $request->server->all());
//        dd($httpKernelBrowser->getResponse());
        return $httpKernelBrowser->getResponse();
    }
    
    protected function handleRequest_______________(Request $request): Response
    {
        $httpClient = $this->createHttpClient();
        $response = $httpClient->handleRequest($request);
        return $response;
    }
}
