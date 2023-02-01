<?php

namespace ZnSandbox\Sandbox\Kafka\Messenger\Transport;

use longlang\phpkafka\Consumer\ConsumeMessage;
use longlang\phpkafka\Consumer\Consumer;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\TransportMessageIdStamp;
use Symfony\Component\Messenger\Transport\Receiver\ReceiverInterface;
use Symfony\Component\Messenger\Transport\Sender\SenderInterface;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;
use ZnSandbox\Sandbox\Kafka\Messenger\Stamp\ConsumeMessageStamp;
use ZnSandbox\Sandbox\Kafka\Messenger\Stamp\TopicStamp;

class KafkaReceiver implements ReceiverInterface
{

    public function __construct(
        protected SerializerInterface $serializer,
        protected Consumer $consumer,
        protected SenderInterface $sender
    ) {
    }

    public function get(): iterable
    {
        $consumeMessage = $this->consumer->consume();
        if ($consumeMessage) {
            $envelope = $this->decode($consumeMessage);
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
        $this->ack($envelope);
    }

    protected function decode(ConsumeMessage $consumeMessage): Envelope
    {
        $data = json_decode($consumeMessage->getValue(), JSON_OBJECT_AS_ARRAY);
        $envelope = $this->serializer->decode($data);
        $envelope = $envelope->with(new TransportMessageIdStamp($consumeMessage->getKey()));
        $envelope = $envelope->with(new TopicStamp($consumeMessage->getTopic()));
        $envelope = $envelope->with(new ConsumeMessageStamp($consumeMessage));
        return $envelope;
    }
}
