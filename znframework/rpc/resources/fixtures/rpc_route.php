<?php

return [
	'deps' => [
        'rbac_item',
    ],
	'collection' => \ZnFramework\Rpc\Domain\Helpers\RoutesHelper::getAllRoutes(),
];
