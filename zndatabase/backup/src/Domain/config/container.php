<?php

return [
	'definitions' => [],
	'singletons' => [
		'ZnDatabase\\Backup\\Domain\\Interfaces\\Services\\DumpServiceInterface' => 'ZnDatabase\\Backup\\Domain\\Services\\DumpService',
		'ZnDatabase\\Backup\\Domain\\Interfaces\\Repositories\\DumpRepositoryInterface' => 'ZnDatabase\\Backup\\Domain\\Repositories\\File\\DumpRepository',
	],
];