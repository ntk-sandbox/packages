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
use ZnSandbox\Sandbox\WebTest\Domain\Libs\MakesHttpRequests;

abstract class BaseCommand extends Command
{
    
    protected function createHttpClient(): JsonHttpClient
    {
        $apps = [
            'web' => WebApp::class,
            'json-rpc' => RpcApp::class,
            'admin' => AdminApp::class,
        ];

        $container = ContainerHelper::getContainer();
        $appFactory = new AppFactory($container, $apps);
        $httpClient = new JsonHttpClient($appFactory);
        return $httpClient;
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
