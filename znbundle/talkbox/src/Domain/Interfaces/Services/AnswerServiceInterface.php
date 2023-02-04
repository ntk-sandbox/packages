<?php

namespace Untek\Bundle\TalkBox\Domain\Interfaces\Services;

use Untek\Bundle\TalkBox\Domain\Entities\AnswerEntity;
use Untek\Domain\Service\Interfaces\CrudServiceInterface;

interface AnswerServiceInterface extends CrudServiceInterface
{

    public function findOneByRequestTextOrCreate(string $word): AnswerEntity;

}

