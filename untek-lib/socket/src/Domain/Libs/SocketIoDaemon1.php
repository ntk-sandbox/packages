<?php

namespace Untek\Lib\Socket\Domain\Libs;

use Workerman\Worker;
use Untek\Lib\Socket\Domain\Libs\Handlers\TcpHandler;
use Untek\Lib\Socket\Domain\Libs\Handlers\WsHandler;
use Untek\Lib\Socket\Domain\Repositories\Ram\ConnectionRepository;
use Untek\User\Authentication\Domain\Interfaces\Services\AuthServiceInterface;

//use PHPSocketIO\SocketIO;

class SocketIoDaemon1
{

//    private $users = [];
    private $tcpWorker;
    private $wsWorker;
    private $localTcpUrl = 'tcp://127.0.0.1:1234';
    private $localWsUrl = 'websocket://0.0.0.0:8001';
    private $connectionRepository;
//    private $authService;

    public function __construct(
        ConnectionRepository $connectionRepository
//        AuthServiceInterface $authService
    )
    {
//        $this->authService = $authService;
        $this->connectionRepository = $connectionRepository;
        // массив для связи соединения пользователя и необходимого нам параметра

        $transport = new Transport($this->localTcpUrl);
        
        // создаём ws-сервер, к которому будут подключаться все наши пользователи
        $this->wsWorker = new Worker($this->localWsUrl);

        // создаём локальный tcp-сервер, чтобы отправлять на него сообщения из кода нашего сайта
        $this->tcpWorker = new Worker($this->localTcpUrl);
        
        $wsHandler = new WsHandler($transport, $this->wsWorker, $this->tcpWorker, $connectionRepository, $authService);
        $tcpHandler = new TcpHandler($transport, $this->wsWorker, $this->tcpWorker, $connectionRepository);

        // создаём обработчик сообщений, который будет срабатывать,
        // когда на локальный tcp-сокет приходит сообщение
        $this->tcpWorker->onMessage = [$tcpHandler, 'onTcpMessage'];
        
        // создаём обработчик, который будет выполняться при запуске ws-сервера
        $this->wsWorker->onWorkerStart = [$wsHandler, 'onWsStart'];
        $this->wsWorker->onConnect = [$wsHandler, 'onWsConnect'];
        $this->wsWorker->onClose = [$wsHandler, 'onWsClose'];
        $this->wsWorker->onMessage = [$wsHandler, 'onWsMessage'];
    }

    public function runAll()
    {
        // Run worker
        Worker::runAll();
    }
}
