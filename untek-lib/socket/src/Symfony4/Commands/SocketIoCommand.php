<?php

namespace Untek\Lib\Socket\Symfony4\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Untek\Lib\Socket\Domain\Libs\SocketIoDaemon as SocketDaemon;

class SocketIoCommand extends Command
{

    protected static $defaultName = 'socketio:worker';
    private $socketDaemon;

    public function __construct(SocketDaemon $socketDaemon)
    {
        parent::__construct(self::$defaultName);
        $this->socketDaemon = $socketDaemon;
    }

    protected function configure()
    {
        $this->addArgument('workerCommand', InputArgument::OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        global $argv;

        $argv[1] = $input->getArgument('workerCommand');

        /*if($input->getArgument('workerCommand') == 'start') {
            $argv[1] = 'start';
        } elseif ($input->getArgument('workerCommand') == 'connections') {
            $argv[1] = 'connections';
        } elseif ($input->getArgument('workerCommand') == 'status') {
            $argv[1] = 'status';
        }*/

        $this->socketDaemon->runAll();

        return Command::SUCCESS;
    }
}
