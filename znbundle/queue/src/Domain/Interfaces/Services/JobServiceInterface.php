<?php

namespace Untek\Bundle\Queue\Domain\Interfaces\Services;

use Untek\Bundle\Queue\Domain\Entities\TotalEntity;
use Untek\Bundle\Queue\Domain\Enums\PriorityEnum;
use Untek\Bundle\Queue\Domain\Interfaces\JobInterface;

interface JobServiceInterface
{

    public function push(JobInterface $job, int $priority = PriorityEnum::NORMAL, string $channel = null);

    public function runAll(string $channel = null): TotalEntity;

    public function touch(): void;
}