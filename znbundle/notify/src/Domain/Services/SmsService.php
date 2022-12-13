<?php

namespace ZnBundle\Notify\Domain\Services;

use ZnBundle\Notify\Domain\Entities\SmsEntity;
use ZnBundle\Notify\Domain\Enums\ChannelEnum;
use ZnBundle\Notify\Domain\Interfaces\Repositories\SmsRepositoryInterface;
use ZnBundle\Notify\Domain\Interfaces\Services\SmsServiceInterface;
use ZnBundle\Notify\Domain\Jobs\SendSmsJob;
use ZnBundle\Queue\Domain\Enums\PriorityEnum;
use ZnBundle\Queue\Domain\Interfaces\Services\JobServiceInterface;
use Psr\Container\ContainerInterface;

class SmsService implements SmsServiceInterface
{

    private $smsRepository;
    private $jobService;
    private $container;

    public function __construct(
        SmsRepositoryInterface $smsRepository,
        JobServiceInterface $jobService,
        ContainerInterface $container
    )
    {
        $this->smsRepository = $smsRepository;
        $this->jobService = $jobService;
        $this->container = $container;
    }

    public function push(SmsEntity $emailEntity, $priority = PriorityEnum::NORMAL)
    {
        $emailJob = new SendSmsJob($this->container);
        $emailJob->entity = $emailEntity;
        $pushResult = $this->jobService->push($emailJob, $priority, ChannelEnum::SMS);
    }

}
