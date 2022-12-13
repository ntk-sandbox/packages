<?php

use ZnLib\Fixture\Domain\Libs\FixtureGenerator;

$fixture = new FixtureGenerator;
$fixture->setCount(200);
$fixture->setCallback(function ($index, FixtureGenerator $fixtureFactory) {
    return [
        'id' => $index,
        'tag_id' => $fixtureFactory->ordIndex($index, 7),
        'post_id' => ceil($index / 2),
    ];
});
return $fixture->generateCollection();
