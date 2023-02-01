<?php

namespace ZnSandbox\Sandbox\Kafka\Factories;

use ZnSandbox\Sandbox\Kafka\Messenger\Transport\KafkaReceiver;
use longlang\phpkafka\Consumer\Consumer;
use longlang\phpkafka\Consumer\ConsumerConfig;
use Psr\Container\ContainerInterface;
use ZnCore\App\Interfaces\EnvStorageInterface;

class KafkaTransportFactory
{

    public function __construct(
        private ContainerInterface $container,
        private EnvStorageInterface $envStorage
    ) {
    }

    public function createReceiver(string $serializerClass, string $senderClass, string $topic): KafkaReceiver
    {
        $serializer = $this->container->get($serializerClass);
        $sender = $this->container->get($senderClass);
        $consumer = $this->createConsumer($topic);
        return new KafkaReceiver($serializer, $consumer, $sender);
    }

    public function createConsumer(string $topic): Consumer
    {
        $config = new ConsumerConfig();
        $config->setBroker($this->envStorage->get('KAFKA_BROKER'));
        $config->setTopic($topic);
        $config->setGroupId($this->envStorage->get('KAFKA_GROUP_ID'));
        $config->setClientId($this->envStorage->get('KAFKA_CLIENT_ID'));
        $config->setGroupInstanceId($topic . '-instance');
        return new Consumer($config);
    }
}
