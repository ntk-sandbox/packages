<?php

use ZnUser\Rbac\Domain\Facades\FixtureGeneratorFacade;

return [
    'deps' => [
        'rbac_item',
    ],
    'collection' => FixtureGeneratorFacade::generateInheritanceCollection(),
];