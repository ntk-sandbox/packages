<?php

use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use ZnCore\Env\Helpers\EnvHelper;
use ZnBundle\Log\Domain\Interfaces\Repositories\LogRepositoryInterface;
use ZnBundle\Log\Domain\Monolog\Handler\EloquentHandler;
use ZnBundle\Log\Domain\Repositories\Eloquent\LogRepository;
use ZnCore\App\Interfaces\EnvStorageInterface;
use ZnCore\Text\Helpers\TemplateHelper;

return [
    'singletons' => [
        'ZnBundle\Log\Domain\Interfaces\Repositories\HistoryRepositoryInterface' => 'ZnBundle\Log\Domain\Repositories\Json\HistoryRepository',
        'ZnBundle\Log\Domain\Interfaces\Services\HistoryServiceInterface' => 'ZnBundle\Log\Domain\Services\HistoryService',

        LogRepositoryInterface::class => LogRepository::class,
        HandlerInterface::class => function (ContainerInterface $container) {
            /** @var EnvStorageInterface $envStorage */
            $envStorage = $container->get(EnvStorageInterface::class);

            $channel = 'application';
            
            $driver = $envStorage->get('LOG_DRIVER') ?: null;
            if ($driver == 'file') {
                
                $fileMask = $envStorage->get('LOG_FILE_MASK');
                if($fileMask) {
                    $now = new \DateTime();
                    $replacement = [
                        'channel' => $channel,
                        'year' => $now->format('Y'),
                        'month' => $now->format('m'),
                        'day' => $now->format('d'),
                        'hour' => $now->format('H'),
                        'minute' => $now->format('i'),
                        'second' => $now->format('s'),
                    ];
                    $logFileName = $envStorage->get('LOG_DIRECTORY') . '/' . TemplateHelper::render($fileMask, $replacement, '{{', '}}');
                } else {
                    $logFileName = $envStorage->get('LOG_DIRECTORY') . '/'.$channel.'.json';
                }
                
                $handler = new StreamHandler($logFileName);
                $formatterClass = $envStorage->get('LOG_FORMATTER') ?: JsonFormatter::class;
                $formatter = $container->get($formatterClass);
                $handler->setFormatter($formatter);
            } elseif ($driver == 'db') {
                /** @var AbstractProcessingHandler $handler */
                $handler = $container->get(EloquentHandler::class);
            } else {
//                $handler = new \Monolog\Handler\NullHandler();
                throw new Exception('Not found handler!');
            }
            return $handler;
        },
        LoggerInterface::class => function (ContainerInterface $container) {
            /** @var EnvStorageInterface $envStorage */
            $envStorage = $container->get(EnvStorageInterface::class);

            $driver = $envStorage->get('LOG_DRIVER') ?: null;
            if ($driver == null) {
                $logger = new NullLogger();
            } else {
                $handler = $container->get(HandlerInterface::class);
                $level = EnvHelper::isDebug() ? Logger::DEBUG : Logger::ERROR;
                $handler->setLevel($level);
                $logger = new Logger('application');
                $logger->pushHandler($handler);
            }
            return $logger;
        },
    ],
];
