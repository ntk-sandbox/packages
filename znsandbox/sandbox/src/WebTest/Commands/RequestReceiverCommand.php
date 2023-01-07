<?php

namespace ZnSandbox\Sandbox\WebTest\Commands;

use App\Application\Admin\Libs\AdminApp;
use App\Application\Rpc\Libs\RpcApp;
use App\Application\Web\Libs\WebApp;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ZnCore\Collection\Libs\Collection;
use ZnCore\Container\Helpers\ContainerHelper;
use ZnCrypt\Base\Domain\Helpers\SafeBase64Helper;
use ZnCrypt\Base\Domain\Libs\Encoders\CollectionEncoder;
use ZnLib\Components\Format\Encoders\ChainEncoder;
use ZnLib\Components\Format\Encoders\PhpSerializeEncoder;
use ZnLib\Components\Format\Encoders\SafeBase64Encoder;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\AppFactory;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\JsonHttpClient;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\HttpClient;

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

        $httpClient = $this->createHttpClient();

        $requestEncoder = $this->createEncoder();
        
        $unserializedRequest = $requestEncoder->decode($encodedRequest);
        $response = $httpClient->handleRequest($unserializedRequest);
        
//        $response = $httpClient->postJson('/json-rpc', $jsonRpcRequest);
        
        $encodedResponse = $requestEncoder->encode($response);
        $output->write($encodedResponse);

        return 0;
    }
}
