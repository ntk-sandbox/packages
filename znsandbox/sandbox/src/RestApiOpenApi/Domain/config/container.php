<?php

use ZnSandbox\Sandbox\RestApiOpenApi\Domain\Libs\OpenApi3\OpenApi3;

return [
	'singletons' => [
	    OpenApi3::class => function() {
            return new OpenApi3($_ENV['OPEN_API_REST_API_SOURCE_DIRECTORY']);
        }
	],
];