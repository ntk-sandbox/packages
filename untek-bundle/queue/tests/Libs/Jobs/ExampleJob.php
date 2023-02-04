<?php

namespace Untek\Bundle\Queue\Tests\Libs\Jobs;

use Untek\Bundle\Queue\Domain\Interfaces\JobInterface;
use Untek\Domain\Entity\Exceptions\AlreadyExistsException;
use Untek\Core\Container\Interfaces\ContainerAwareInterface;
use Untek\Core\Container\Traits\ContainerAwareTrait;

class ExampleJob implements JobInterface//, ContainerAwareInterface
{

    use ContainerAwareTrait;

    public $messageText;

    public function run()
    {
        if ($this->messageText == 'qwerty') {
            throw new AlreadyExistsException($this->messageText);
        }
    }

}