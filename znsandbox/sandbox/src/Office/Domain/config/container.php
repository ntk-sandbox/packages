<?php

return [
	/*'entities' => [
		'ZnSandbox\\Sandbox\\Office\\Domain\\Entities\\DocXEntity' => 'ZnSandbox\\Sandbox\\Office\\Domain\\Interfaces\\Repositories\\DocXRepositoryInterface',
	],*/
	'singletons' => [
		'ZnSandbox\\Sandbox\\Office\\Domain\\Interfaces\\Services\\DocXServiceInterface' => 'ZnSandbox\\Sandbox\\Office\\Domain\\Services\\DocXService',
		'ZnSandbox\\Sandbox\\Office\\Domain\\Interfaces\\Repositories\\DocXRepositoryInterface' => 'ZnSandbox\\Sandbox\\Office\\Domain\\Repositories\\File\\DocXRepository',
	],
];