<?php

namespace ZnSandbox\Sandbox\WebTest\Commands;

use App\Application\Admin\Libs\AdminApp;
use App\Application\Rpc\Libs\RpcApp;
use App\Application\Web\Libs\WebApp;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\AppFactory;
use ZnSandbox\Sandbox\WebTest\Domain\Libs\MakesHttpRequests;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ZnCore\Container\Helpers\ContainerHelper;

class SendRestRequestCommand extends Command
{

    protected static $defaultName = 'http:request:send';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<fg=white># Send request</>');


        $apps = [
            'web' => WebApp::class,
            'json-rpc' => RpcApp::class,
            'admin' => AdminApp::class,
        ];

        $container = ContainerHelper::getContainer();
        $appFactory = new AppFactory($container, $apps);
        $httpClient = new MakesHttpRequests($appFactory);

        /** @var MakesHttpRequests $httpClient */
//        $factory = ContainerHelper::getContainer()->get(MakesHttpRequests::class);
        $response = $httpClient->postJson(
            '/json-rpc',
            [
                "jsonrpc" => "2.0",
                "method" => "authentication.getTokenByPassword",
                'params' => [
                    'body' => [
                        'login' => 'admin',
                        'password' => 'Wwwqqq111',
                    ],
                ],
            ]
        );

        $output->writeln($response->getContent());
        return 0;
    }
}
