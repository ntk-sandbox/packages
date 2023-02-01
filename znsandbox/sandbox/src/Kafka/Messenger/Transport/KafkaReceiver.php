<?php

namespace ZnSandbox\Sandbox\Kafka\Messenger\Transport;

use ZnSandbox\Sandbox\Kafka\Messenger\Stamp\ConsumeMessageStamp;
use ZnSandbox\Sandbox\Kafka\Messenger\Stamp\TopicStamp;
use longlang\phpkafka\Consumer\Consumer;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\TransportMessageIdStamp;
use Symfony\Component\Messenger\Transport\Receiver\ReceiverInterface;
use Symfony\Component\Messenger\Transport\Sender\SenderInterface;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

class KafkaReceiver implements ReceiverInterface
{

    private string $topicForReject;

    public function __construct(
        private SerializerInterface $serializer,
        private Consumer $consumer,
        private SenderInterface $sender
    ) {
    }

    public function setTopicForReject(string $topicForReject): void
    {
        $this->topicForReject = $topicForReject;
    }

    public function get(): iterable
    {
        $consumeMessage = $this->consumer->consume();
        if ($consumeMessage) {
            $data = json_decode($consumeMessage->getValue(), JSON_OBJECT_AS_ARRAY);
            $envelope = $this->serializer->decode($data);
            $envelope = $envelope->with(new TransportMessageIdStamp($consumeMessage->getKey()));
            $envelope = $envelope->with(new TopicStamp($consumeMessage->getTopic()));
            $envelope = $envelope->with(new ConsumeMessageStamp($consumeMessage));
            return [$envelope];
        }
        return [];
    }

    public function ack(Envelope $envelope): void
    {
        /** @var ConsumeMessageStamp $consumeMessageStamp */
        $consumeMessageStamp = $envelope->last(ConsumeMessageStamp::class);
        $this->consumer->ack($consumeMessageStamp->getConsumeMessage());
    }

    public function reject(Envelope $envelope): void
    {
        if (isset($this->topicForReject)) {
            /** @var TopicStamp $topicStamp */
            $topicStamp = $envelope->last(TopicStamp::class);
            $topicStamp->setTopic($this->topicForReject);
            $this->sender->send($envelope);
        }
        $this->ack($envelope);
    }
}
