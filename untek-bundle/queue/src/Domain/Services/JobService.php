<?php

namespace Untek\Bundle\Queue\Domain\Services;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Untek\Bundle\Queue\Domain\Entities\JobEntity;
use Untek\Bundle\Queue\Domain\Entities\TotalEntity;
use Untek\Bundle\Queue\Domain\Enums\PriorityEnum;
use Untek\Bundle\Queue\Domain\Interfaces\JobInterface;
use Untek\Bundle\Queue\Domain\Interfaces\Repositories\JobRepositoryInterface;
use Untek\Bundle\Queue\Domain\Interfaces\Services\JobServiceInterface;
use Untek\Bundle\Queue\Domain\Interfaces\Services\ScheduleServiceInterface;
use Untek\Bundle\Queue\Domain\Queries\NewTaskQuery;
use Untek\Core\Instance\Helpers\PropertyHelper;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Model\Entity\Helpers\EntityHelper;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Service\Base\BaseService;
use Untek\Model\Validator\Helpers\ValidationHelper;
use Untek\Lib\Components\Status\Enums\StatusEnum;

/**
 * @method JobEntity createEntity(array $attributes = [])
 * @method JobRepositoryInterface getRepository()
 */
class JobService extends BaseService implements JobServiceInterface
{

    protected $container;
    protected $scheduleService;
    protected $logger;

    public function __construct(
        JobRepositoryInterface $repository,
        ScheduleServiceInterface $scheduleService,
        ContainerInterface $container,
        EntityManagerInterface $entityManager,
        LoggerInterface $logger
    ) {
        $this->setRepository($repository);
        $this->container = $container;
        $this->setEntityManager($entityManager);
        $this->scheduleService = $scheduleService;
        $this->logger = $logger;
    }

    public function push(JobInterface $job, int $priority = PriorityEnum::NORMAL, string $channel = null)
    {
        //$isAvailable = $this->beforeMethod([$this, 'push']);
        $jobEntity = $this->createEntity();
        $jobEntity->setChannel($channel);
        $jobEntity->setJob($job);
        $jobEntity->setPriority($priority);
        //$jobEntity->setDelay();
        ValidationHelper::validateEntity($jobEntity);

        if (getenv('CRON_DIRECT_RUN') ?: false) {
            $jobInstance = $this->getJobInstance($jobEntity, $this->container);
            $jobInstance->run();
            return $jobEntity;
        }

        $this->getRepository()->create($jobEntity);

        $this->touch();

        return $jobEntity;
    }

    public function touch(): void
    {
        if (getenv('CRON_AUTORUN') ?: false) {
            $this->runAll();
        }
    }

    public function newTasks(string $channel = null): Enumerable
    {
        $scheduleJobCollection = $this->scheduleService->runAll($channel);
//        $this->persistCollection($scheduleJobCollection);
        $query = new NewTaskQuery($channel);
        $jobCollection = $this->getRepository()->findAll($query);
        return $jobCollection;
    }

    public function runAll(string $channel = null): TotalEntity
    {
//        $scheduleJobCollection = $this->scheduleService->runAll($channel);
//        $this->persistCollection($scheduleJobCollection);

//        dd($scheduleJobCollection);

        $jobCollection = $this->newTasks($channel);

//        $query = new NewTaskQuery($channel);
        /** @var \Untek\Core\Collection\Interfaces\Enumerable | JobEntity[] $jobCollection */
//        $jobCollection = $this->getRepository()->findAll($query);


        $totalEntity = new TotalEntity;
        foreach ($jobCollection as $jobEntity) {
            $isSuccess = $this->runJob($jobEntity);
            if ($isSuccess) {
                $totalEntity->incrementSuccess($jobEntity);
            } else {
                $totalEntity->incrementFail($jobEntity);
            }
        }
        return $totalEntity;
    }

    /**
     * @param Enumerable | JobEntity[] $collection
     */
    private function persistCollection(Enumerable $collection): void
    {
        if ($collection->isEmpty()) {
            return;
        }
        foreach ($collection as $jobEntity) {
            $this->getEntityManager()->persist($jobEntity);
        }
    }

    public function runJob(JobEntity $jobEntity)
    {
        $jobInstance = $this->getJobInstance($jobEntity, $this->container);
        $jobEntity->incrementAttempt();
        $isSuccess = false;


        $logContext = [
            'job' => EntityHelper::toArray($jobEntity, true),
        ];

        try {
            $jobInstance->run();
            $jobEntity->setCompleted();
            $isSuccess = true;
        } catch (\Throwable $e) {
            $logContext['error'] = EntityHelper::toArray($e, true);
            if ($jobEntity->getAttempt() >= 3) {
                $jobEntity->setStatus(StatusEnum::BLOCKED);
            }
        }
        $this->getRepository()->update($jobEntity);

        if ($isSuccess) {
            $this->logger->info('CRON task run success', $logContext);
        } else {
            $this->logger->error('CRON task run fail', $logContext);
        }

        return $isSuccess;
    }

    private function getJobInstance(JobEntity $jobEntity, ContainerInterface $container): JobInterface
    {
        $jobClass = $jobEntity->getClass();
        /** @var JobInterface $jobInstance */

        //$jobInstance = DiHelper::make($jobClass, $container);
        $data = $jobEntity->getJob();

//        $jobInstance = $container->get($jobClass);
//        PropertyHelper::setAttributes($jobInstance, $data);

        $jobInstance = $this->createJobInstance($jobClass, $data);
        return $jobInstance;
    }

    public function createJobInstance(string $className, array $attributes): JobInterface
    {
        $jobInstance = $this->container->get($className);
        PropertyHelper::setAttributes($jobInstance, $attributes);
        return $jobInstance;
    }
}
