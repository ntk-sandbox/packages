<?php

namespace ZnSandbox\Sandbox\WebTest\Commands;

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

        /** @var MakesHttpRequests $factory */
        $factory = ContainerHelper::getContainer()->get(MakesHttpRequests::class);
        $response = $factory->postJson('/json-rpc', [
            "jsonrpc" => "2.0",
            "method" => "authentication.getTokenByPassword",
            'params' => [
                'body' => [
                    'login' => 'admin',
                    'password' => 'Wwwqqq111',
                ],
            ],
        ]);

        dd($response->getContent());

        $output->writeln('');
        return 0;
    }
}
