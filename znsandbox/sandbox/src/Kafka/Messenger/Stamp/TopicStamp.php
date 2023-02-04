<?php

namespace Untek\Sandbox\Sandbox\Kafka\Messenger\Stamp;

use Symfony\Component\Messenger\Stamp\StampInterface;

final class TopicStamp implements StampInterface
{
    private string $topic;

    public function __construct(string $topic)
    {
        $this->topic = $topic;
    }

    public function getTopic(): string
    {
        return $this->topic;
    }

    public function setTopic(string $topic): void
    {
        $this->topic = $topic;
    }
}
