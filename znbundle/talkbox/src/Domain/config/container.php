<?php

return [
    'singletons' => [
        'Untek\Bundle\TalkBox\Domain\Interfaces\Repositories\TagRepositoryInterface' => 'Untek\Bundle\TalkBox\Domain\Repositories\Eloquent\TagRepository',
        'Untek\Bundle\TalkBox\Domain\Interfaces\Repositories\AnswerRepositoryInterface' => 'Untek\Bundle\TalkBox\Domain\Repositories\Eloquent\AnswerRepository',
        'Untek\Bundle\TalkBox\Domain\Interfaces\Repositories\AnswerTagRepositoryInterface' => 'Untek\Bundle\TalkBox\Domain\Repositories\Eloquent\AnswerTagRepository',
        'Untek\Bundle\TalkBox\Domain\Interfaces\Repositories\AnswerOptionRepositoryInterface' => 'Untek\Bundle\TalkBox\Domain\Repositories\Eloquent\AnswerOptionRepository',
    ],
];