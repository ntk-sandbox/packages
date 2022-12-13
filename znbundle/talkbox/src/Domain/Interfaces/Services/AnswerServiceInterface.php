<?php

namespace ZnBundle\TalkBox\Domain\Interfaces\Services;

use ZnBundle\TalkBox\Domain\Entities\AnswerEntity;
use ZnDomain\Service\Interfaces\CrudServiceInterface;

interface AnswerServiceInterface extends CrudServiceInterface
{

    public function findOneByRequestTextOrCreate(string $word): AnswerEntity;

}

