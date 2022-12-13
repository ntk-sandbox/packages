<?php

namespace ZnBundle\Notify\Domain\Services;

use ZnDomain\Service\Base\BaseService;
use ZnBundle\Notify\Domain\Enums\FlashMessageTypeEnum;
use ZnBundle\Notify\Domain\Interfaces\Repositories\FlashRepositoryInterface;
use ZnBundle\Notify\Domain\Interfaces\Services\FlashServiceInterface;

class FlashService extends BaseService implements FlashServiceInterface
{

    const DEFAULT_DELAY = 5000;

    public function __construct(FlashRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    public function addSuccess(string $message, int $delay = self::DEFAULT_DELAY)
    {
        $this->add(FlashMessageTypeEnum::SUCCESS, $message, $delay);
    }

    public function addInfo(string $message, int $delay = self::DEFAULT_DELAY)
    {
        $this->add(FlashMessageTypeEnum::INFO, $message, $delay);
    }

    public function addWarning(string $message, int $delay = self::DEFAULT_DELAY)
    {
        $this->add(FlashMessageTypeEnum::WARNING, $message, $delay);
    }

    public function addError(string $message, int $delay = self::DEFAULT_DELAY)
    {
        $this->add(FlashMessageTypeEnum::ERROR, $message, $delay);
    }

    public function add(string $type, string $message, int $delay = self::DEFAULT_DELAY)
    {
        $this->getRepository()->add($type, $message, $delay);
    }
}
