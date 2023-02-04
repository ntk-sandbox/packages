<?php

return [
	'deps' => [
        'rbac_item',
    ],
	'collection' => \Untek\Framework\Rpc\Domain\Helpers\RoutesHelper::getAllRoutes(),
];
