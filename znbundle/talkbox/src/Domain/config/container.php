<?php

return [
    'singletons' => [
        'ZnBundle\TalkBox\Domain\Interfaces\Repositories\TagRepositoryInterface' => 'ZnBundle\TalkBox\Domain\Repositories\Eloquent\TagRepository',
        'ZnBundle\TalkBox\Domain\Interfaces\Repositories\AnswerRepositoryInterface' => 'ZnBundle\TalkBox\Domain\Repositories\Eloquent\AnswerRepository',
        'ZnBundle\TalkBox\Domain\Interfaces\Repositories\AnswerTagRepositoryInterface' => 'ZnBundle\TalkBox\Domain\Repositories\Eloquent\AnswerTagRepository',
        'ZnBundle\TalkBox\Domain\Interfaces\Repositories\AnswerOptionRepositoryInterface' => 'ZnBundle\TalkBox\Domain\Repositories\Eloquent\AnswerOptionRepository',
    ],
];