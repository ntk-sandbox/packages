<?php

namespace ZnBundle\Notify\Domain\Services;

use Psr\Container\ContainerInterface;
use ZnBundle\Notify\Domain\Entities\EmailEntity;
use ZnBundle\Notify\Domain\Enums\ChannelEnum;
use ZnBundle\Notify\Domain\Interfaces\Repositories\EmailRepositoryInterface;
use ZnBundle\Notify\Domain\Interfaces\Services\EmailServiceInterface;
use ZnBundle\Notify\Domain\Jobs\SendEmailJob;
use ZnBundle\Queue\Domain\Enums\PriorityEnum;
use ZnBundle\Queue\Domain\Interfaces\Services\JobServiceInterface;
use ZnCore\DotEnv\Domain\Libs\DotEnv;

class EmailService implements EmailServiceInterface
{

    private $emailRepository;
    private $jobService;
    private $container;

    public function __construct(EmailRepositoryInterface $emailRepository, JobServiceInterface $jobService, ContainerInterface $container)
    {
        $this->emailRepository = $emailRepository;
        $this->jobService = $jobService;
        $this->container = $container;
    }

    public function push(EmailEntity $emailEntity, $priority = PriorityEnum::NORMAL)
    {
        if($emailEntity->getFrom() == null) {
            $emailEntity->setFrom(DotEnv::get('EMAIL_FROM'));
        }
        $emailJob = new SendEmailJob($this->container);
        $emailJob->entity = $emailEntity;
        $pushResult = $this->jobService->push($emailJob, $priority, ChannelEnum::EMAIL);
    }

}
