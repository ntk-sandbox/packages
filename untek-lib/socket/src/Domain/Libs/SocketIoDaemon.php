<?php

namespace Untek\Lib\Socket\Domain\Libs;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Workerman\Connection\ConnectionInterface;
use Workerman\Worker;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Core\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\Lib\Socket\Domain\Entities\SocketEventEntity;
use Untek\Lib\Socket\Domain\Enums\SocketEventEnum;
use Untek\Lib\Socket\Domain\Repositories\Ram\ConnectionRepository;
use Untek\User\Authentication\Domain\Interfaces\Services\AuthServiceInterface;

//use PHPSocketIO\SocketIO;

class SocketIoDaemon
{

    private $users = [];
    private $tcpWorker;
    private $wsWorker;
    private $localUrl = 'tcp://127.0.0.1:1234';
    private $connectionRepository;
//    private $authService;

    public function __construct(
        ConnectionRepository $connectionRepository,
//        AuthServiceInterface $authService,
        private UserProviderInterface $userProvider
    )
    {
//        $this->authService = $authService;
        $this->connectionRepository = $connectionRepository;
        // массив для связи соединения пользователя и необходимого нам параметра

        // создаём ws-сервер, к которому будут подключаться все наши пользователи
        $this->wsWorker = new Worker("websocket://0.0.0.0:8001");
        // создаём обработчик, который будет выполняться при запуске ws-сервера
        $this->wsWorker->onWorkerStart = [$this, 'onWsStart'];
        $this->wsWorker->onConnect = [$this, 'onWsConnect'];
        $this->wsWorker->onClose = [$this, 'onWsClose'];
        $this->wsWorker->onMessage = [$this, 'onWsMessage'];
    }

    public function sendMessageToTcp(SocketEventEntity $eventEntity)
    {
        // соединяемся с локальным tcp-сервером
        try {
            $instance = stream_socket_client($this->localUrl);
            $serialized = serialize($eventEntity);
            // отправляем сообщение
            fwrite($instance, $serialized . "\n");
        } catch (\Exception $e) {
            return false;
        }
    }

    public function onWsStart()
    {
        // создаём локальный tcp-сервер, чтобы отправлять на него сообщения из кода нашего сайта
        $this->tcpWorker = new Worker($this->localUrl);
        // создаём обработчик сообщений, который будет срабатывать,
        // когда на локальный tcp-сокет приходит сообщение
        $this->tcpWorker->onMessage = [$this, 'onTcpMessage'];
        $this->tcpWorker->listen();
    }

    protected function auth($params)//: int
    {
        /*$userId = intval($params['userId']);
        if (!empty($userId)) {
            return $userId;
        }*/

        $credentials = $params['token'] ?? null;
        if (!empty($credentials)) {
            /** @var IdentityEntityInterface $identityEntity */
//            $identityEntity = $this->authService->authenticationByToken($token);
            $identityEntity = $this->userProvider->loadUserByIdentifier($credentials);
            return $identityEntity->getId();
        }

        throw new AuthenticationException('Empty user id');
    }

    public function onWsConnect(ConnectionInterface $connection)
    {
        $connection->onWebSocketConnect = function ($connection) {
            $userId = $this->auth($_GET);
            // при подключении нового пользователя сохраняем get-параметр, который же сами и передали со страницы сайта
            $this->connectionRepository->addConnection($userId, $connection);
            // вместо get-параметра можно также использовать параметр из cookie, например $_COOKIE['PHPSESSID']

            $event = new SocketEventEntity;
            $event->setUserId($userId);
            $event->setName(SocketEventEnum::CONNECT);
            $event->setData([
                'totalConnections' => $this->connectionRepository->countByUserId($userId),
            ]);
            $this->sendToWebSocket($event, $connection);
        };
    }

    public function onWsClose(ConnectionInterface $connection)
    {
        $this->connectionRepository->remove($connection);
    }

    public function onWsMessage(ConnectionInterface $connection,  $jsonMessage)
    {
        $data = json_decode($jsonMessage, JSON_OBJECT_AS_ARRAY);

        $event = new SocketEventEntity;
        $event->setUserId($data['toAddress']);
        // messenger.newMessage
        $event->setName('cryptoMessage.p2p');
        $event->setData([
            'document' => $data['document'],
        ]);
//            $event->setData($data);
        $this->sendMessageToTcp($event);
        
        
        
//        dump($data);
        //$this->connectionRepository->remove($connection);
    }

    public function onTcpMessage(ConnectionInterface $connection, string $data)
    {
        /** @var SocketEventEntity $eventEntity */
        $eventEntity = unserialize($data);
        $userId = $eventEntity->getUserId();
        // отправляем сообщение пользователю по userId
        try {
            $userConnections = $this->connectionRepository->allByUserId($userId);
            foreach ($userConnections as $userConnection) {
                $this->sendToWebSocket($eventEntity, $userConnection);
                echo 'send '.hash('crc32b', $data).' to ' . $userId . PHP_EOL;
            }
        } catch (NotFoundException $e) {
        }
    }

    public function runAll()
    {
        // Run worker
        Worker::runAll();
    }

    private function sendToWebSocket(SocketEventEntity $socketEventEntity, ConnectionInterface $connection)
    {
        $eventArray = EntityHelper::toArray($socketEventEntity);
        $json = json_encode($eventArray);
        $connection->send($json);
    }
}
