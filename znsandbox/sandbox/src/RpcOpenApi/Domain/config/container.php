<?php

use ZnSandbox\Sandbox\RpcOpenApi\Domain\Libs\OpenApi3\OpenApi3;

return [
	'singletons' => [
	    OpenApi3::class => function() {
            return new OpenApi3(getenv('OPEN_API_RPC_SOURCE_DIRECTORY'));
        }
	],
];