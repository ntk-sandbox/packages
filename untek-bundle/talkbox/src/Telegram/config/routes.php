<?php

return [
    [
        'matcher' => \Untek\Framework\Telegram\Domain\Matchers\AnyMatcher::class,
        'action' => \Untek\Bundle\TalkBox\Telegram\Actions\DataBaseAction::class,
        'help' => '
Ифнобот реагирует, если понимает фразу.
Он может ответить на распространенные вопросы, на пример:
привет!
сколько тебе лет?
как дела?
Может понять, даже если вы написали слова с ошибками.
Перестановка слов местами мало на что влияет.',
    ],
];
