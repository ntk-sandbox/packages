<?php

namespace ZnSandbox\Sandbox\Kafka\Messenger\Transport;

use ZnSandbox\Sandbox\Kafka\Messenger\Stamp\TopicStamp;
use longlang\phpkafka\Producer\ProduceMessage;
use longlang\phpkafka\Producer\Producer;
use longlang\phpkafka\Producer\ProducerConfig;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\TransportMessageIdStamp;
use Symfony\Component\Messenger\Transport\Sender\SenderInterface;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

class KafkaSender implements SenderInterface
{

    private string $topic;
    private string $broker;
    private string $clientId;

    public function __construct(
        private SerializerInterface $serializer,
    ) {
    }

    public function setTopic(string $topic): void
    {
        $this->topic = $topic;
    }

    public function setBroker(string $broker): void
    {
        $this->broker = $broker;
    }

    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
    }

    public function send(Envelope $envelope): Envelope
    {
        $id = uniqid('', true);
        $envelope = $envelope->with(new TransportMessageIdStamp($id));
        /** @var TopicStamp $topicStamp */
        $topicStamp = $envelope->last(TopicStamp::class);
        if (empty($topicStamp)) {
            $envelope = $envelope->with(new TopicStamp($this->topic));
        }
        $encodedEnvelope = $this->serializer->encode($envelope);
        $topicStamp = $envelope->last(TopicStamp::class);
        $produceMessage = new ProduceMessage($topicStamp->getTopic(), $encodedEnvelope['body'], $id);
        $this->getProducerInstance()->sendBatch([$produceMessage]);
        return $envelope;
    }

    private function getProducerInstance(): Producer
    {
        $config = new ProducerConfig();
        $config->setBootstrapServer($this->broker);
        $config->setUpdateBrokers(true);
        $config->setClientId($this->clientId);
        $config->setAcks(-1);
        return new Producer($config);
    }
}
