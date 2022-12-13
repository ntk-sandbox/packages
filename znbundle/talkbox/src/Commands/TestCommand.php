<?php

namespace ZnBundle\TalkBox\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Workerman\Worker;

class TestCommand extends Command
{

    protected static $defaultName = 'dialog:test';

    private function workerman() {
        // массив для связи соединения пользователя и необходимого нам параметра
        $users = [];

        // создаём ws-сервер, к которому будут подключаться все наши пользователи
        $ws_worker = new Worker("websocket://0.0.0.0:8000");
        // создаём обработчик, который будет выполняться при запуске ws-сервера
        $ws_worker->onWorkerStart = function() use (&$users)
        {
            // создаём локальный tcp-сервер, чтобы отправлять на него сообщения из кода нашего сайта
            $inner_tcp_worker = new Worker("tcp://127.0.0.1:1234");
            // создаём обработчик сообщений, который будет срабатывать,
            // когда на локальный tcp-сокет приходит сообщение
            $inner_tcp_worker->onMessage = function($connection, $data) use (&$users) {
                $data = json_decode($data);
                // отправляем сообщение пользователю по userId
                foreach ($users as $client) {
                    $webconnection = $users[$data->user];
                    $webconnection->send($data->message);
                }
            };
            $inner_tcp_worker->listen();
        };

        $ws_worker->onMessage = function($connection, $data)
        {
            // Send hello $data
            $connection->send('hello ' . $data);
            echo "Message from user {$_GET['user']}" . PHP_EOL;
        };

        $ws_worker->onConnect = function($connection) use (&$users)
        {
            $connection->onWebSocketConnect = function($connection) use (&$users)
            {
                echo "Connection user {$_GET['user']}" . PHP_EOL;
                // при подключении нового пользователя сохраняем get-параметр, который же сами и передали со страницы сайта
                $users[$_GET['user']] = $connection;

                // вместо get-параметра можно также использовать параметр из cookie, например $_COOKIE['PHPSESSID']
            };
        };

        $ws_worker->onClose = function($connection) use(&$users)
        {
            // удаляем параметр при отключении пользователя
            $user = array_search($connection, $users);
            echo "Disconnection user {$user}" . PHP_EOL;
            unset($users[$user]);

        };

        // Run worker
        Worker::runAll();
    }

}
